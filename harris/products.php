<?=template_header('Products')?>
<div class="products content-wrapper">
    <h1>Products</h1>
    <div>
                 <form method="post" class="search-box" >
                    <button class="search-btn" type="submit" name="searchbutton" onclick="openSearchBox()">
                    <i class="fa fa-search" aria-hidden="true"></i></button>
                    <input class="search-txt" type="text" placeholder="Search for product" autofocus name="search">
                </form>
        </div>
    </div>

<div class="container">
        <div>
        	<br />
            <div>                				
				<div class="list-group">
					<h3>Price</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="500000" />
                    <p id="price_show">500 - 500000</p>
                    <div id="price_range"></div>
                </div>				
                <div>
					<h3>Brand</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT(bname) FROM products ORDER BY id DESC";
                    $statement = $pdo->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector brand" value="<?php echo $row['bname']; ?>"  > <?php echo $row['bname']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>

				

            <div class="col-md-9">
            	<br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
<style>
     #loading
  {
	  text-align:center; 
	  background: url('loader.gif') no-repeat center; 
	  height: 150px;
  }
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
      
        $.ajax({
            url:"index.php?page=fetch_data",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:500,
        max:500000,
        values:[500, 500000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});
</script>
<?=template_footer()?>