<?php
namespace App\Imports;
   
use App\Product;
use App\User;
use App\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
    
class ProductsImport implements ToModel, WithHeadingRow
{
 
    public function model(array $row)
    {
      
            //echo '<pre/>';print_r($row);die;
            $checkAlreadyExist  = Product::where('code',$row['product_code'])->first();
            if(empty($checkAlreadyExist)){
                $company  = User::where('name',$row['company_name'])->first();
                $category  = Category::where('name',$row['category'])->first();
              
                 $data = new Product;
                $data->company_id =  $company->id;
                $data->category_id = $category->id;
                 $data->name =  $row['product_name'];
                $data->code = $row['product_code'];
                 $data->cost =  $row['product_cost'];
                $data->opening_stock = $row['opening_stock']; 
                $data->closeing_stock = $row['opening_stock']; 
                $data->description =  $row['product_description'];
                $data->image = $row['product_image'];
                $data->save();
            }
    
            
   
    }
  
}