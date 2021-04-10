@include('include.header');
<main id="main" class="main-site">
<div class="container">
<div class="summary summary-checkout">
    <div class="summary-item payment-method">
        <h4 class="title-box">Chọn hình thức thanh toán</h4>

     <form action="{{URL::to('/order-place')}}" method="get">
         {{csrf_field()}}
         <div class="choose-payment-methods">
             <label class="payment-method">
                 <input name="payment_option" id="payment-method-bank" value="1" type="checkbox">
                 <span>Trả bằng thẻ ATM</span>
             </label>
             <label class="payment-method">
                 <input name="payment_option" id="payment-method-visa" value="2" type="checkbox">
                 <span>Thanh toán khi giao hàng</span>

             </label>
             <label class="payment-method">
                 <input name="payment_option" id="payment-method-paypal" value="3̣" type="checkbox">
                 <span>Thanh toán thẻ ghi nợ</span>
             </label>
             <p class="summary-info grand-total"><span>Grand Total</span> <span class="grand-total-price">$100.00</span></p>

             <button type="submit" class="btn btn-medium">Place order now</button>

         </div>
     </form>

    </div>
    <div class="summary-item shipping-method">
        <h4 class="title-box f-title">Shipping method</h4>
        <p class="summary-info"><span class="title">Flat Rate</span></p>
        <p class="summary-info"><span class="title">Fixed $50.00</span></p>
        <h4 class="title-box">Discount Codes</h4>
        <p class="row-in-form">
            <label for="coupon-code">Enter Your Coupon code:</label>
            <input id="coupon-code" type="text" name="coupon-code" value="" placeholder="">
        </p>
        <a href="#" class="btn btn-small">Apply</a>
    </div>
</div>
</div>
</main>
@include('include.footer');
