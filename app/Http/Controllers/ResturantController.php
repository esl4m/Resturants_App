<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class ResturantController extends Controller
{
    public $resturants = [];
    public $myFavorites = [];
    /**
     * Instantiate a new controller Resturant.
     *
     * @return void
     */
    public function __construct()
    {
        if (config('resturants_obj.restaurants')) {
            $this->my_resturants = config('resturants_obj.restaurants');
        }
        else {
            abort(404, 'Not Found');
        }
    }

    /**
     * Display a list of resturants.
     * 
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        if ($this->my_resturants) {
            // Sort the resturants //
            $this->resturants = $this->sortingList($this->my_resturants, 'open', 'minCost');

            return view('resturants', ['all_resturants' => $this->resturants]);
        }
    }

    /**
     * Called function Sorting from incoming resturant request
     * 
     * @param  $keyword
     * @return \Illuminate\Http\Response
     */
    public function sorting(Request $request){
        if($request->input('sorting')){
            $sortby = $request->input('sorting');
            // Sort the base resturant by the new keyword
            $new_sorted_resturants = $this->sortingList($this->my_resturants, '', $sortby);

            // Return json to load data into ResturantTable
            return response()->json(['errors' => null, 'data' => $new_sorted_resturants, 'status' => 'success'], 200);
        }
        else {
            abort(404, 'Not Found');
        }
    }

    /**
     * Add Favorite Resturant
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addFav(Request $request)
    {
        if($request->input('fav_name')) {
            $newFav = $request->input('fav_name');
            // Check if not in myFav array
            
            if (!in_array($newFav, $this->myFavorites)){
                array_push($this->myFavorites, $newFav);

                // TODO: .. Adds to browser / localstorage / cookies

                return response()->json(['errors' => null, 'data' => $newFav." added to your favorites!", 'status' => 'success'], 200);
            }
        }
        else {
            abort(404, 'Not Found');
        }
    }

    /**
     * Remove Favorite Resturant
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeFav(Request $request)
    {
        if($request->input('fav_name')) {
            $removeFav = $request->input('fav_name');
            if (in_array($removeFav , $this->myFavorites)) {
                array_splice($this->myFavorites, $removeFav, 1);

                return response()->json(['errors' => null, 'data' => $removeFav." removed from favorites!", 'status' => 'success'], 200);
            }
        }
        else {
            abort(404, 'Not Found');
        }
    }

    /**
     * Sort resturants
     * 
     * @param  array $new_resturants
     * @param  $status
     * @return array
     */
    public function sortingList($new_resturants, $status="open", $sortBy="bestMatch")
    {
        $asc = [
            "newest",
            "distance",
            "averageProductPrice",
            "deliveryCosts",
            "minCost"
        ];
        
        // Setting default values
        if ($status == '') {
            $status = 'open';
        }
        if ($sortBy == ''){
            $sortBy = 'bestMatch';
        }

        switch ($status) {
            case 'open':
                $order = array('open', 'order ahead', 'closed');
                break;

            case 'order-ahead':
                $order = array('order ahead', 'open', 'closed');
                break;

            case 'closed':
                $order = array('closed', 'order ahead', 'open');
                break;

            default:
                $order = array('open', 'order ahead', 'closed');
        }

        // Sorting by values
        usort($new_resturants, function ($a, $b) use ($order, $sortBy, $asc) {
            if ($a['status'] == $b['status']) {
                // check if SortBy value is in ascending array:
                if (in_array($sortBy, $asc)){
                    return ($a['sortingValues'][$sortBy] - $b['sortingValues'][$sortBy]);
                }
                // else return descending 
                return ($b['sortingValues'][$sortBy] - $a['sortingValues'][$sortBy]);
            }
            
            $pos_a = array_search($a['status'], $order);
            $pos_b = array_search($b['status'], $order);
            return $pos_a - $pos_b;
        });
        
        return $new_resturants;
   }
}
