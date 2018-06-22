<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Slide;
use App\User;
use Auth;
use Hash;
use App\Order;
use ShoppingCart;
use App\OrderDetail;

class PageController extends Controller
{
    public function index()
    {
        $products = Product::select('*')->orderby('price', 'desc')->paginate(9);
        $slide = Slide::all();
        $newProduct = Product::select('*')->orderby('id', 'desc')->limit(20)->get();

        return view('page.home', compact('products', 'slide', 'newProduct'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)->get();
        return view('page.product_details', compact('product', 'relatedProducts'));
    }

    public function cart()
    {
        return view('page.cart');
    }

    public function getRegister()
    {
        return view('page.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'gender' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                're_password' => 'required|same:password',
                'address' => 'required',
                'phone' => 'required'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'gender.required' => 'Vui lòng chọn giới tính',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email này đã có người sử dụng',
                'name.required' => 'Vui lòng nhập tên đầy đủ của bạn',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu phải từ 6 đến 20 ký tự',
                'password.max' => 'Mật khẩu phải từ 6 đến 20 ký tự',
                're_password.required' => 'Vui lòng nhập lại mật khẩu',
                're_password.same' => 'Hai mật khẩu không giống nhau',
                'address.required' => 'Vui lòng nhập địa chỉ',
                'phone.required' => 'Vui lòng nhập số điện thoại'
            ]
        );

        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();

        session()->flash('success', 'Bạn đẵ đăng ký tài khoản thành công với Email là: ' . $user->email . ', Vui lòng đăng nhâp !');
        return redirect()->route('dang_nhap');
    }

    public function getLogin()
    {
        return view('page.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Vui lòng nhập email mật khẩu',
                'password.min' => 'Mật khẩu phải từ 6 đến 20 ký tự',
                'password.max' => 'Mật khẩu phải từ 6 đến 20 ký tự'
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back()->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Email hoặc mật khẩu không chính xác']);
        }
    }

    public function dangXuat()
    {
        Auth::logout();
        return redirect()->route('home_page');
    }

    public function getOrder()
    {
        return view('page.order');
    }

    public function postOrder(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'gender' => 'required',
                'email' => 'required|email|unique:users,email',
                'address' => 'required',
                'phone' => 'required',
                'payment' => 'required'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'gender.required' => 'Vui lòng chọn giới tính',
                'email.email' => 'Email không đúng định dạng',
                'name.required' => 'Vui lòng nhập tên đầy đủ của người nhận hàng',
                'address.required' => 'Vui lòng nhập địa chỉ nhận hàng',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'payment.required' => 'Chưa chọn phương thức thanh toán'
            ]
        );

        $order = new Order();
        if (Auth::check()) {
            $order->user_id = Auth::user()->id;
        }
        $order->name = $request->name;
        $order->gender = $request->gender;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->total = ShoppingCart::totalPrice();
        $order->payment = $request->payment;
        if (!empty($request->note)) {
            $order->note = $request->note;
        }
        $order->save();

        foreach (ShoppingCart::all() as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item->id;
            $orderDetail->quantity = $item->qty;
            $orderDetail->price = $item->price;
            $orderDetail->color = $item->color;
            $orderDetail->save();
        }

        ShoppingCart::destroy(); // xóa hết giỏ hàng
        session()->flash('success', 'Cảm ơn bạn đã đặt hàng, nhân viên của chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất !');
        return redirect()->back();
    }

    public function promotion()
    {
        $promotionProducts = Product::select('*')->where('discount', '>', 0)->orderby('discount', 'desc')->paginate(9);

        return view('page.promotion', compact('promotionProducts'));
    }

    public function search(Request $request)
    {
        $list = Product::select('*');

        if (isset($request->keyword) && !empty($request->keyword)) {
            $list = $list->where('name', 'like', '%' . $request->keyword . '%');
        }
        if (isset($request->category) && !empty($request->category)) {
            $list = $list->where('category_id', $request->category);
        }
        if (isset($request->price1) && !empty($request->price1) && isset($request->price2) && !empty($request->price2)) {
            $list = $list->whereBetween('price', [$request->price1, $request->price2]);
        }
        if (isset($request->priceBigger) && !empty($request->priceBigger)) {
            $list = $list->where('price', '>', $request->priceBigger);
        }
        $list = $list->orderby('price', 'desc')->paginate(9);

        return view('page.search', ['products' => $list]);
    }

    public function contact()
    {
        return view('page.contact');
    }
}
