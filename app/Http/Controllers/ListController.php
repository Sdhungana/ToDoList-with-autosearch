<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyList;

class ListController extends Controller
{
   
    public function index()
    {
        $datas = MyList::all();     
        return view('list',compact('datas'));
    }

   
    public function store(Request $request)
    {
        $item = new MyList;
        $item->items = $request->text;
        $item->save();
        // return redirect('list');
    }

    public function update(Request $request)
    {
        
        $id = MyList::find($request->id);
        $id->items = $request->text;
        $id->save();
        // return redirect('list');
    }

    public function destroy(Request $request)
    {
        MyList::where('id',$request->id)->delete();
        // return redirect('list');
       
    }
    public function search(Request $request)
    {
        $term = $request->term;
        $items = MyList::where('items','LIKE','%'.$term.'%')->get();
        if(count($items) == 0){
            $noItem[] = 'No item Found';
        }
        else{
            foreach($items as $key => $value){
                $noItem[] = $value->items;
            }
        }
        return $noItem;
    }
}
