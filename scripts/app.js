
    //Changes settings in my account area.
    function settings(choice1, choice2) {
    	if(choice2 == 1 || choice2 == 4){
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: { 
                    q: choice1,
                    r: choice2,
                    action: "myAccChoice"
                },
                success:  function(data){
                    $('#show_settings').html(data);
                }
            });
        }else{
            var variable = create_array("text", "return");
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: {
                    email: variable.email,
                    name: variable.name,
                    residental: variable.residental_adress,
                    zip: variable.zip_code,
                    country: variable.country,
                    mobile: variable.mobile,
                    city: variable.city,
                    region: variable.region,
                    current_password: variable.current_password,
                    new_password: variable.new_password, 
                    q: choice1,
                    r: choice2,
                    action: "myAccChoice"
                },
                success:  function(data){
                    if(choice2 === 3){
                        $('#show_settings').html(data);
                    }else{
                        $('#show_settings').html(data);
                    }
                }
            });
        }
    }

    //A separate search function for admin area, it's currently the same as prod_search, had thoughts about making more admin stuff and that's why it's separate.
    function admin_prod_search(name) {
        $.ajax({
            type: "POST",
            url: "./php/phpScripts.php",
            data: { 
                q: name,
                action: "adminProdSearch"
            },
            success:  function(data){
                $('#search_result').html(data);
            }
        });
    }

    //Adds a product to the cart.
    function add_prod(str, choice) {
        $.ajax({
            type: "POST",
            url: "./php/phpScripts.php",
            data: { 
                q: str,
                r: choice,
                action: "addCart"
            },
            success:  function(data){
                $('#show_cart').html(data);
                $('#shopping_cart').html(data);
            }
        });
    }

    //Creates an array from text fields for saving users given information about name, address etc. Used in my account under my account and at checkout page.
    function create_array(text, property){
        if(property === "return"){
               return data;
        }else{
            if(typeof data === "undefined" || typeof data === null){
                window.data = {};
                data[property] = text;
            }else{
                console.log(data);
                data[property] = text;
            }
        }
    }

    //Used in check_out.php. Specifies if user should use account specified shipping information or use specified information given at the moment.
    function shipping(choice1, choice2) {
        if(choice2 == 1 || choice2 == 2){
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: { 
                    q: choice1,
                    r: choice2,
                    action: "myAccChoice"
                },
                success:  function(data){
                    $('#check_out').html(data);
                }
            });
        }
    }

    //Shows the current shopping cart at check_out.php and in the top menu.
    function show_cart(choice1, choice2) {
        $.ajax({
            type: "POST",
            url: "./php/phpScripts.php",
            data: { 
                q: choice1,
                r: choice2,
                action: "showCart"
            },
            success:  function(data){
                $('#show_cart').html(data);
                $('#shopping_cart').html(data);
            }
        });
    }

    //When in checkout, this creates an order.
    function place_order(choice1, choice2) {
        //Uses account specified information to create order.
        if(choice1 == "account" && choice2 == "account"){
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: { 
                    q: choice1,
                    r: choice2,
                    action: "addOrder"
                },
                success:  function(data){
                    $('#show_cart').html(data);
                    $('#shopping_cart').html(data);

                    alert("Your order has been placed.");
                }
            });
            //Uses user specified information.
        }else{
            var variable = create_array("text", "return");
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: {
                    email: variable.email,
                    name: variable.name,
                    residental: variable.residental_adress,
                    zip: variable.zip_code,
                    country: variable.country,
                    mobile: variable.mobile,
                    city: variable.city,
                    region: variable.region,
                    q: choice1,
                    r: choice2,
                    action: "addOrder"
                },
                success:  function(data){
                    $('#show_cart').html(data);
                    $('#shopping_cart').html(data);

                    alert("Your order has been placed.");
                }
            });
        }
    }   

    //Admin tools located in admin area.
    function admin(choice1, choice2) {
        //Admin search field.
        if(choice1 == "search"){
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: {
                    action: "adminSearch"
                },
                success:  function(data){
                    $('#show_settings').html(data);
                }
            });
            //List of all orders for admin.
        }else if(choice1 == "order"){
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: {
                    action: "orderList"
                },
                success:  function(data){
                    $('#show_settings').html(data);
                }
            });
            //Shows detailed order.
        }else if (choice1 == "orderDetail"){
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: {
                    q: choice2,
                    action: "orderDetail"
                },
                success:  function(data){
                    $('#show_settings').html(data);
                    changeStatus('noUpd', choice2)
                }
            });
            //Shows sale page for admins.
        }else if(choice1 == "sale"){
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: {
                    action: "sale"
                },
                success:  function(data){
                    $('#show_settings').html(data);
                }
            });
        }
    }

    //Shows products. Used in product.php page.
    function show_products(choice, currentpage){
        $.ajax({
            type: "POST",
            url: "./php/phpScripts.php",
            data: {
                q: choice, 
                c: currentpage,
                action: "products"
            },
            success:  function(data){
                $('#products').html(data);
            }
        });
    }

    //Searches for proucts in the product.php page.
    function prod_search(name) {
        if(name != ""){
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: {
                    q: name, 
                    action: "prodSearch"
                },
                success:  function(data){
                    $('#products').html(data);
                }
            });
            //If search field is empty, show all products.
        }else{
            show_products("all");
        }
    }

    //Sets the sale given in the admin area.
    function setSale(percent, choice1){
        if(choice1 == 0){
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: {
                    q: percent,
                    action: "setSale"
                },
                success:  function(data){
                    $('#currentPercent').html(data);
                    alert("The sale has now been changed!");
                    setSale('string', 1);
                }
            });
        }else if(choice1 == 1){
            $.ajax({
                type: "POST",
                url: "./php/phpScripts.php",
                data: {
                    action: "curSale"
                },
                success:  function(data){
                    $('#currentPercent').html(data);
                }
            });
        }
    }

    //Changes status on shipped variable located in admin area.
    function changeStatus(choice, id) {
        $.ajax({
            type: "POST",
            url: "./php/phpScripts.php",
            data: {
                q: id,
                r: choice,
                action: "changeStatus"
            },
            success:  function(data){
                $('#ship').html(data);
            }
        });
    }