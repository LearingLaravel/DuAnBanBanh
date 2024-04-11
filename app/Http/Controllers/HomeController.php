<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart2;
use App\Models\ProductType;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\User;
use App\Models\BillDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{   
    //sign in 
    public function getSignUp(){
        return view('signup');
    } 

    public function postSignup(Request $req){
        $this->validate($req,
        ['email'=>'required|email|unique:users,email',
           'password'=>'required|min:6|max:20',
           'fullname'=>'required',
           'repassword'=>'required|same:password', 
        ],
        ['email.required'=>'Vui lòng nhập email',
        'email.email'=>'Không đúng định dạng email',
        'email.unique'=>'Email đã có người sử  dụng',
        'password.required'=>'Vui lòng nhập mật khẩu',
        'repassword.same'=>'Mật khẩu không giống nhau',
        'password.min'=>'Mật khẩu ít nhất 6 ký tự'
       ]);
  
       $user=new User();
       $user->full_name=$req->fullname;
       $user->email=$req->email;
       $user->password=Hash::make($req->password);
       $user->phone=$req->phone;
       $user->address=$req->address;
       $user->level=2;
       $user->save();
       return redirect()->back()->with('success','Tạo tài khoản thành công');
     }
     
    
     
    public function getProductType($id)
    {
        $producttype = ProductType::find($id);
        return view('product_type', compact('producttype'));
    }
    
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        if (!is_null($oldCart)) {
            $cart = $oldCart;
        } else {
            $cart = new Cart2();
        }
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }


    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["qty"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    
    

    public function delCartItem($id){
        $oldCart=Session::has('cart')?Session::get('cart'):null;
        
        if (!is_null($oldCart)) {
            $cart = $oldCart;
        } else {
            $cart = new Cart2();
        }
        
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else Session::forget('cart');
        return redirect()->back();
    }


    public function getCheckout(){
        return view('checkout');
    }

    public function postCheckout(Request $request){
        $cart=Session::get('cart');
        $customer=new Customer();
        $customer->name=$request->input('name');
        $customer->gender=$request->input('gender');
        $customer->email=$request->input('email');
        $customer->address=$request->input('address');
        $customer->phone_number=$request->input('phone_number');
        $customer->note=$request->input('notes');
        $customer->save();

        $bill=new Bill();
        $bill->id_customer=$customer->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$request->input('payment_method');
        $bill->note=$request->input('notes');
        $bill->save();

        foreach($cart->items as $key=>$value)
        {
            $bill_detail=new BillDetail();
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$key;
            $bill_detail->quantity=$value['qty'];
            $bill_detail->unit_price=$value['price']/$value['qty'];
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('success','Đặt hàng thành công');
    }


    public function updateCartItem(Request $request)
{
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');

    // Xử lý cập nhật số lượng sản phẩm trong giỏ hàng ở đây
    // Ví dụ: 
    $product = Product::find($productId);
    $product->quantity = $quantity;
    $product->price = $quantity * $product->unit_price;
    $product->save();

    return response()->json(['success' => true]);
}



// public function updatetocart(Request $request)
// {
//     $prod_id = $request->input('product_id');
//     $quantity = $request->input('quantity');

//     if(Session::get('cart'))
//     {
//         $cookie_data = stripslashes(Session::get('cart'));
//         $cart_data = json_decode($cookie_data, true);

//         $item_id_list = array_column($cart_data, 'item_id');
//         $prod_id_is_there = $prod_id;

//         if(in_array($prod_id_is_there, $item_id_list))
//         {
//             foreach($cart_data as $keys => $values)
//             {
//                 if($cart_data[$keys]["item_id"] == $prod_id)
//                 {
//                     $cart_data[$keys]["item_quantity"] =  $quantity;
//                     $item_data = json_encode($cart_data);
//                     $minutes = 60;
//                     Session::queue(Session::make('cart', $item_data, $minutes));
//                     return response()->json(['status'=>'"'.$cart_data[$keys]["item_name"].'" Quantity Updated']);
//                 }
//             }
//         }
//     }
// }

    
public function updateToCart(Request $request)
{
    $productId = $request->input('product_id');
    $quantity = $request->input('qty');
    $cart = session()->get('cart') ?? new Cart2();
    
    $cart->updateQuantity($productId, $quantity);
    $cart->updateTotalPrice();
    session()->put('cart', $cart);
    return response()->json(['status' => 'Cart updated successfully']);
}

    
}