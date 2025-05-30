<?php 
    
    require('connection.inc.php');
    
    $category_id = "";
    $name = "";
    $mrp = "";
    $price = "";
    $qty = "";
    $image = "";
    $short_desc = "";
    $description = "";
    $meta_title = "";
    $meta_desc = "";
    $meta_keyword = "";

    $msg = '';
    if(isset($_GET['id']) &&  $_GET['id']!=''){
        $id = $_GET['id'];
        $sql = "SELECT * FROM `product` WHERE `id`='$id'";
        $res = mysqli_query($con,$sql);

        $check = mysqli_num_rows($res);
        
        if($check > 0){
             $row = mysqli_fetch_assoc($res);
            $categories = isset($row['categories_id']) ? $row['categories_id'] : '';
            $name = isset($row['name']) ? $row['name'] : '';
            $mrp = isset($row['mrp']) ? $row['mrp'] : '';
            $price = isset($row['price']) ? $row['price'] : '';
            $qty = isset($row['qty']) ? $row['qty'] : '';
            $short_desc = isset($row['short_desc']) ? $row['short_desc'] : '';
            $description = isset($row['description']) ? $row['description'] : '';
            $meta_title = isset($row['meta_title']) ? $row['meta_title'] : '';
            $meta_desc = isset($row['meta_desc']) ? $row['meta_desc'] : '';
            $meta_keyword = isset($row['meta_keyword']) ? $row['meta_keyword'] : '';
            

        }else{
            header('location:product.php');
            die();
        }

       
    }

    if(isset($_POST['submit'])){
        // echo "<pre>";
        // print_r($_POST);die;
        $category_id = $_POST['categories_id'];
        $name = $_POST['name'];
        $mrp = $_POST['mrp'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $short_desc = $_POST['short_desc'];
        $description = $_POST['description'];
        $meta_title = $_POST['meta_title'];
        $meta_desc = $_POST['meta_desc'];
        $meta_keyword = $_POST['meta_keyword'];
       


        

        //duplicate product not add and update
         if (isset($_GET['id']) && $_GET['id'] != '') {
            $sql = "SELECT * FROM `product` WHERE `name`='$name' AND `id`!='$id'";
         }else {
            $sql = "SELECT * FROM `product` WHERE `name`='$name'";
         }
            $res = mysqli_query($con, $sql);
            $check = mysqli_num_rows($res);
        //duplicate product not add and update
        
            
         if($check > 0){
            $msg = "Product already exists";
         }else{
            if(isset($_GET['id']) && $_GET['id']!=''){
                $sql = "UPDATE `product` SET `categories_id`='$category_id',`name`='$name',`mrp`='$mrp',`price`='$price',`qty`='$qty',`short_desc`='$short_desc',`description`='$description',`meta_title`='$meta_title',`meta_desc`='$meta_desc',`meta_keyword`='$meta_keyword',`status`='1' WHERE `id`='$id'";
            }else{
                //file upload code start
                $image = rand(1111111111,9999999999)."_".$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],'media/'.$image);
                //file upload code end
                $sql = "INSERT INTO `product`(`categories_id`, `name`, `mrp`, `price`, `qty`,`image`,`short_desc`, `description`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES ('$category_id','$name','$mrp','$price','$qty','$image','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1)";
            }
             $res = mysqli_query($con,$sql);
         }
        //  echo "<script>
        //             setTimeout(()=>{
        //                 window.location.href='product.php'; 
        //             },2000);
        //         </script>";
    }
    require('header.inc.php'); 
?>


 <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                   
                    <div class="col-lg-12 col-md-8 col-sm-12">
                         
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Add Product</strong>
                               
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">

                                    <div class="mb-3">
                                        <label for="categories" class="form-label">Categories</label>
                                        <select name="categories_id" class="form-control" required>
                                            <option value="">---select categories--</option>
                                            <?php
                                                $sql = "SELECT * FROM `categories`";
                                                $res = mysqli_query($con,$sql);
                                                while($row = mysqli_fetch_array($res)){
                                             ?>

                                             <?php if($row['id']==$categories) {  ?>
                                                <option selected value="<?php echo $row['id'] ?>"><?php echo $row['categories'] ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['categories'] ?></option>
                                            <?php } ?>
                                                
                                             <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Enter name" required>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Mrp</label>
                                        <input type="text" class="form-control" name="mrp" value="<?php echo $mrp; ?>" placeholder="Enter mrp" required>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Price</label>
                                        <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" placeholder="Enter price" required>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Qty</label>
                                        <input type="text" class="form-control" name="qty" value="<?php echo $qty; ?>" placeholder="Enter qty" required>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image" required>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Short Desc</label>
                                        <textarea name="short_desc" class="form-control" placeholder="Enter short description" required><?php echo $short_desc; ?></textarea>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" placeholder="Enter description" required><?php echo $description; ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Meta title</label>
                                        <textarea name="meta_title" class="form-control" placeholder="Enter meta title" required><?php echo $meta_title; ?></textarea>
                                    </div>


                                    <div class="mb-3">
                                        <label for="name" class="form-label">Meta description</label>
                                        <textarea name="meta_desc" class="form-control" placeholder="Enter meta description" required><?php echo $meta_desc; ?></textarea>
                                    </div>


                                    <div class="mb-3">
                                        <label for="name" class="form-label">Meta Keyword</label>
                                        <textarea name="meta_keyword" class="form-control" placeholder="Enter meta keyword" required><?php echo $meta_keyword; ?></textarea>
                                    </div>




                                                    


                                    
                                    
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <hr>
                                <?php
                                    if(isset($msg)){ ?>
                                        <p><?php echo $msg; ?></p>
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
            </div>




          

            

        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>


<?php require('footer.inc.php'); ?>