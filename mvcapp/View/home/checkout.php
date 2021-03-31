<?php

$items = $this->getCart()->getItems()->getData();

$customer = $this->getCart()->getCustomer();
$cartBillingAddress = $this->getBillingAddress();
$cartShippingAddress = $this->getShippingAddress();


?>

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="panel-group checkout-steps" id="accordion">

                        <div class="panel panel-default checkout-step-01">
                            <!-- panel-heading -->
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                                        <span>1</span>Shipping & Billing Address
                                    </a>
                                </h4>
                            </div>
                            <!-- panel-heading -->

                            <div id="collapseOne" class="panel-collapse collapse in">
                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle">Shipping Address</h4>
                                            <!-- <p class="text title-tag-line">Please log in below:</p> -->
                                            <form class="register-form" role="form">
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                                    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                                                    <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" placeholder="">
                                                    <a href="#" class="forgot-password">Forgot your Password?</a>
                                                </div>
                                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                                            </form>
                                        </div>
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle">Billing Address</h4>
                                            <!-- <p class="text title-tag-line">Please log in below:</p> -->
                                            <form class="register-form" role="form">
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                                    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                                                    <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" placeholder="">
                                                    <a href="#" class="forgot-password">Forgot your Password?</a>
                                                </div>
                                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                                            </form>
                                        </div>
                                        <!-- already-registered-login -->

                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div>
                            <!-- row -->
                        </div>

                    </div>
                    <!-- /.checkout-steps -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.checkout-box -->
    </div>
    <!-- /.container -->
</div>