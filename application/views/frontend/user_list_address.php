<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php/shop">Home</a></li>
                <li class="active">Addresses</li>
            </ol>
            <a href="<?php echo base_url(); ?>index.php/Address/add_user_adds"><button type="submit" class="btn btn-default">Add Address</button></a>
        </div><br>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Address</td>
                        <td class="description">City</td>
                        <td class="price">State</td>
                        <td class="quantity">Country</td>
                        <td class="total">Zipcode</td>
                        <td class="total">Action</td>
                    </tr>
                </thead>
                <tbody>
                             
                            <?php
                             foreach($result as $row) {
                            ?>

                            <tr>
                                <td class="image">
                                    <?php echo $row['address_1']; ?>
                                    </br>
                                    <?php echo $row['address_2']; ?>  
                                </td>

                                <td class="description">
                                    <?php echo $row['ct_name']; ?>
                                </td>

                                <td class="price">
                                    <?php echo $row['st_name']; ?>
                                </td>

                                <td class="quantity">
                                    <?php echo $row['count_name']; ?>
                                </td>

                                <td class="total">
                                    <?php echo $row['zipcode']; ?>
                                </td>

                                <td class="total">
                                      <a href="<?php echo base_url(); ?>index.php/Address/delete_address/<?php echo $row['id']; ?>">
                                      <button class="btn btn_edit" id="btn_edit" value="">Delete</button>
                                      </a>

                                      <a href="<?php echo base_url(); ?>index.php/Address/update_address/<?php echo $row['id']; ?>">
                                      <button class="btn btn_delete">Edit</button>
                                      </a>                               
                                </td>
                            </tr>
                                

                            <?php
                            }                    
                            ?>

                </tbody>
            </table>
        </div>
    </div>
</section>

