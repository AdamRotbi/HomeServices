<?php
           
namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

use Illuminate\Http\Request;
use DataTables;
          
class ProductAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
        if ($request->ajax()) {
  
            $data = Product::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('productAjax');
    }
       
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $input = $request->all();
        $input['id'] = $request->product_id;
        if ($image = $request->file('image')) {
        $destinationPath = 'images/';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $input['image'] = $profileImage;
}
    
// if ($request->has('product_id')) {
//     // Update an existing product
//     $product = Product::find($request->input('product_id'));
//     if ($product) {
//         $product->update($input);
//     } else {
//         // Handle the case where the product doesn't exist
//         return response()->json(['error' => 'Product not found.'], 404);
//     }
// } else {
//     // Create a new product
//     $product = Product::create($input);
// }
// return response()->json(['success' => 'Product saved successfully.']);
// }
        // Store or update the product data
        Product::updateOrCreate(
            ['id' => $request->product_id], // Updated line
            $input
        );
        return response()->json(['success'=>'Product saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
      
        return response()->json(['success'=>'Product deleted successfully.']);
    }


     /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new ProductsImport,request()->file('file'));
               
        return back();
    }

}
?>