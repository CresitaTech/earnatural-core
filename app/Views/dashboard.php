<?php
include('elements/header.php');
?>

<body>
    <!--========== HEADER ==========-->
    <header class="header">
        <div class="header__container">
            <div class="header__user">
                <img src="<?=base_url('public/img/user.svg')?>" alt="">
                <div>
                    <strong>Welcome, Admin</strong>
                    <span>Admin</span>
                </div>
            </div>


            <a href="#" class="header__logo">
                <img src="<?=base_url('public/img/logo.png')?>" />
            </a>

           

            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
        </div>
    </header>

    <!--========== NAV ==========-->
    <div class="nav" id="navbar">
        <nav class="nav__container">
            <div>
                <a href="#" class="nav__link nav__logo">
                    <img src="<?=base_url('public/img/logo-icon.png')?>" />
                    <span class="nav__logo-name">EarNatural</span>
                </a>

                <div class="nav__list">
                    <div class="nav__items">
                        <!-- <h3 class="nav__subtitle">Profile</h3> -->

                        <a href="<?=base_url('home/dashboard')?>" class="nav__link ">
                            <i class='bx bx-home nav__icon'></i>
                            <span class="nav__name">Promo Code</span>
                        </a>
                    </div>


                </div>
            </div>

            <a href="<?=base_url('home/logout')?>" class="nav__link nav__logout">
                <i class='bx bx-log-out nav__icon'></i>
                <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>

    <!--========== CONTENTS ==========-->
    <main>

    <div class="dashboard-statistics">
        <div class="form-row">
            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="statistics-label">Active Promocodes</div>
                                <div class="statistics-value"><?=$summary->active?></div>
                            </div>
                            <div class="col-auto">
                                <div class="statistics-icon bg-orange-light">
                                    <i class="icon fas fa-hand-holding-heart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="statistics-label">Expired Promocodes</div>
                                <div class="statistics-value"><?=$summary->expired?></div>
                            </div>
                            <div class="col-auto">
                                <div class="statistics-icon bg-pink-light">
                                   
                                    <i class="icon fas fa-history"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="statistics-label">Total Promocodes</div>
                                <div class="statistics-value"><?=$summary->total?></div>
                            </div>
                            <div class="col-auto">
                                <div class="statistics-icon bg-green-light">
                                    <i class="icon fas fa-clipboard-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

        <section>
            <div class="header-sec mt-2">
                <div class="row">
                    <div class="col">
                        <h4>Promo Code</h4>
                    </div>
                    <div class="col-auto ml-auto">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popup-promocode">+ Add Promo Code</button>
                    </div>
                </div>
            </div>
            <div class="promocode">
                <div class="row fiter-section">
                    
                    <!-- <div class="col-md-6 col-sm-12 ">
                    <div class="search-section">
                        <i class='bx bx-search' ></i>
                        <i class='bx bx-x-circle'></i>
                        <input type="text" class="form-control form-control-sm" id="" placeholder="Search">
                    </div>
                </div> -->
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-body table-promocode dataTables_wrapper">
                                <div >
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                                <th>Title</th>
                                                <th>Discount</th>
                                                <th>PromoCode</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>StartDate</th>
                                                <th>ExpireDate</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; foreach($userdata as $item){?>
                                            <tr>
                                            <td><?=$i?></td>
                                                <td><?=$item->promocode_title?></td>
                                                <td><?=$item->promocode_discount?></td>
                                                <td><?=$item->promocode?></td>
                                                <td><?=$item->promocode_type?></td>
                                                <td><?=$item->status?></td>
                                                <td><?=$item->start_date?></td>
                                                <td><?=$item->expire_date?></td>
                                                <td><a href="#edit" onclick="edit_promocode(<?=$item->id;?>)" data-toggle="modal" data-target="#promocodeModel" ><i class="fas fa-edit"></i></a>
                                                    <a href="<?=base_url('home/delete_promocode/'.$item->id);?>" ><i class="fas fa-trash-alt"></i></a></td>
                                            </tr>
                                            <?php $i++; } ?>
                                            
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

        </section>
    </main>


    <!-- ADD Promocode -->
    <div class="modal fade" id="popup-promocode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Promocode </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('home/add_promocode');?>" method="post">
				<input type="hidden" class="form-control form-control-sm product_price" id="product_price" name="product_price" readyonly>
                <div class="modal-body">
                        <div class="row">
                            <div class="col form-group">
                                <label for="inputState">Product Name <sup>*</sup></label>
                                <select id="product_name" name="product_name" class="form-control form-control-sm product_name" required>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="Cupantitle">Promo Code Title <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="promo_code_title" name="promocode_title" required>
                            </div>
							
							<div class="col form-group">
                                <label for="Startdate">Promo Code <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="promo_code" name="promocode" required>
                            </div>
							
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="Cupantitle">Promo Code Discount <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="promocode_discount" name="promocode_discount" required>
                            </div>

                            <div class="col form-group">
                                <label for="ExpireDate">Promocode Type <sup>*</sup></label>
                                <select id="promocode_type" name="promocode_type" class="form-control form-control-sm" required>
                                    <option value='Percentage' selected>Percentage</option>
                                    <option value="FlatRate">FlatRate</option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="Startdate">Unit Price <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="unit_price" name="unit_price" required>
                            </div>
                            <div class="col form-group">
                                <label for="ExpireDate">Status <sup>*</sup></label>
                                <select id="status" name="status" class="form-control form-control-sm" required>
                                    <option selected value="Active">Active</option>
                                    <option value="Deactivate">Deactivate</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="Startdate">Start Date <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="start_date" name="start_date" required>
                            </div>
                            <div class="col form-group">
                                <label for="ExpireDate">Expire Date <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="expire_date" name="expire_date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="Remark">Remark</label>
                                <textarea class="form-control form-control-sm" name="remark" id="remark" rows="3"></textarea>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="promocodeModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Promocode </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('home/edit_promocode');?>" method="post" name="editPromocode">
                <input type="hidden" class="form-control form-control-sm" id="id" name="id">
				<input type="hidden" class="form-control form-control-sm product_price" id="product_price" name="product_price" readyonly>

                <div class="modal-body">
                        <div class="row">
                            <div class="col form-group">
                                <label for="inputState">Product Name <sup>*</sup></label>
                                <select id="edit_product_name" name="product_name" class="form-control form-control-sm product_name" required>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="Cupantitle">Promo Code Title <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="edit_promocode_title" name="promocode_title" required>
                            </div>
							
							<div class="col form-group">
                                <label for="Startdate">Promo Code <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="edit_promocode" name="promocode" required>
                            </div>
							
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="Cupantitle">Promo Code Discount <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="edit_promocode_discount" name="promocode_discount" required>
                            </div> 

                            <div class="col form-group">
                                <label for="ExpireDate">Promocode Type <sup>*</sup></label>
                                <select id="edit_promocode_type" name="promocode_type" class="form-control form-control-sm" required onchange="calculateUnitPrice(this.value)">
                                    <option value='Percentage' selected>Percentage</option>
                                    <option value="FlatRate">FlatRate</option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            
							<div class="col form-group">
                                <label for="Startdate">Unit Price <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="edit_unit_price" name="unit_price" required>
                            </div>
                            <div class="col form-group">
                                <label for="ExpireDate">Status <sup>*</sup></label>
                                <select id="edit_status" name="status" class="form-control form-control-sm" required>
                                    <option selected value="Active">Active</option>
                                    <option value="Deactivate">Deactivate</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="Startdate">Start Date <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="edit_start_date" name="start_date" required>
                            </div>
                            <div class="col form-group">
                                <label for="ExpireDate">Expire Date <sup>*</sup></label>
                                <input type="text" class="form-control form-control-sm" id="edit_expire_date" name="expire_date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="Remark">Remark</label>
                                <textarea class="form-control form-control-sm" name="remark" id="edit_remark" rows="3"></textarea>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
                </form>

            </div>
        </div>
    </div>


    <?php
include('elements/footer.php');
?>