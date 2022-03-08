# Laravel Ecommerce API 

## This is a simple Ecommerce REST API that have basic CRUD operations of an ecommerce shop. 
## For installing the application to your local environment:
 clone the repository to your machine.   
 open the directory of project and install the dependencies via "composer install".    
 make database connections on .env file.    
 make migrations via "php artisan migrate".     
 install Laravel passport via "php artisan passport:install".       
 start the application with "php artisan serve".     

# API Documentation
## Endpoints:

 User registration:                           /api/register   
 User Login:                                  /api/login    
 User Logout:                                 /api/logout     

 Get all products:                            /api/products                 
 Get all products of a category:              /api/products/{category_id}      
 Get single product by id:                    /api/single-product/{id}     
 Get all categories:                          /api/categories    
 Get single category by id:                   /categories/{id}     

 Add new product:                             /api/add-product   
 Add multiple products(for bulk operations):  /api/add-products    
 Update a product:                            /api/update-product/{id}    
 Delete a product:                            /api/delete-product/{id}     
 Add new category:                            /api/add-category     
 Update a category:                           /api/update-category/{id}      
 Delete a category:                           /api/delete-category/{id}     

## Data formats that will be sent with Request body must be JSON type with the following formats:

## registration data:
{
    "name": "John Doe",
    "email": "john@doe.com",
    "password": "password",
    "c_password": "password",
    "role": "admin"
}

## login data:
{
    "email": "john@doe.com",
    "password":"password"
}

## add and update category data:
{
    "name":"technolgy"
}

## add and update product data:
{
    "name": "sample product1",
    "category_id": "2",
    "price":"123",
    "description":"lorem ipsum dolor",
    "image":"www.imagelink.com"
}

## add multiple products with bulk route data:
{
   "products": [
    {
    "name": "sample product1",
    "category_id": "1",
    "price":"123",
    "description":"lorem ipsum dolor",
    "image":"www.imagelink.com"
    },
    {
    "name": "sample product2",
    "category_id": "2",
    "price":"123",
    "description":"lorem ipsum dolor",
    "image":"www.imagelink.com"
    },
    {
    "name": "sample product3",
    "category_id": "1",
    "price":"123",
    "description":"lorem ipsum dolor",
    "image":"www.imagelink.com"
    }
   ]
}
