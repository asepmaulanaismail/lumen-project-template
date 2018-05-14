<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Model\Client;
use App\Model\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request){
        $query = Client::select("*");
        if ($request->has("name")){
            $query->where("name", "like", "%".$request->input('name')."%");
        }
        if ($request->has("email")){
            $query->where("email", "like", "%".$request->input('email')."%");
        }
        $response = $query->orderBy("name")->paginate(10);
        return response()->json($response);
    }
    public function show($id){
        $data = Client::find($id);

        $response = json_decode("{}");
        if ($data != null){
            $response->status = true;
            $response->messages = [];
            $data->load("parent");
            $response->data = $data;
        }else{
            $response->status = false;
            $response->messages = ["Client with ID '".$id."' is not found"];
        }
        return response()->json($response);
    }
    public function save(Request $request){
        $response = json_decode("{}");
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:25',
            'password' => 'required|string|min:8',
            'name' => 'required|string|max:25',
            'user_id' => 'required|integer'
        ], $this->validatorMessages);

        if ($validator->fails()) {
            $response->status = false;
            $response->messages = $this->generateMessageArray($validator->errors());
        }else{
            $data = User::find($request->input("user_id"));
            if ($data != null){
                try {
                    $data = new Client();
                    $data->user_id = $request->input("user_id");
                    $data->email = $request->input("email");
                    $data->password = sha1($request->input("password"));
                    $data->name = $request->input("name");
                    $data->created_dt = date('Y-m-d H:i:s');
                    $data->created_by = $request->input("user_id");
                    $data->updated_dt = date('Y-m-d H:i:s');
                    $data->updated_by = $request->input("user_id");
                    $data->save();
        
                    $response->status = true;
                    $response->messages = [];
                } catch (\Illuminate\Database\QueryException $e) {
                    $response->status = false;
                    $response->messages = $e->errorInfo;
                }
            }else{
                $response->status = false;
                $response->messages = ["User with ID '".$request->input("user_id")."' is not found"];
            }
        }

        return response()->json($response);
    }
    public function update(Request $request, $id){
        $response = json_decode("{}");
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:25',
            'name' => 'required|string|max:25',
            'is_active' => 'required|boolean',
            'user_id' => 'required|integer'
        ], $this->validatorMessages);

        if ($validator->fails()) {
            $response->status = false;
            $response->messages = $this->generateMessageArray($validator->errors());
        }else{
            $data = Client::find($id);
            if ($data != null){
                try {
                    $data->email = $request->input("email");
                    $data->name = $request->input("name");
                    $data->is_active = $request->input("is_active");
                    $data->updated_dt = date('Y-m-d H:i:s');
                    $data->updated_by = $request->input("user_id");
                    $data->save();
    
                    $response->status = true;
                    $response->messages = [];
                } catch (\Illuminate\Database\QueryException $e) {
                    $response->status = false;
                    $response->messages = $e->errorInfo;
                }
            }else{
                $response->status = false;
                $response->messages = ["Client with ID '".$id."' is not found"];
            }
        }
        return response()->json($response);
    }
    public function destroy(Request $request, $id){
        $response = json_decode("{}");
        $data = Client::find($id);
        if ($data != null){
            try {
                $data->delete();

                $response->status = true;
                $response->messages = [];
            } catch (\Illuminate\Database\QueryException $e) {
                $response->status = false;
                $response->messages = $e->errorInfo;
            }
        }else{
            $response->status = false;
            $response->messages = ["Client with ID '".$id."' is not found"];
        }
        return response()->json($response);
    }
    public function combo(Request $request){
        $response = json_decode("{}");

        $data = Client::select("id", "name");
        if ($request->has("q"))
            $data->where("name", "like", "%".$request->input("q")."%");
            
        $response->status = true;
        $response->messages = [];
        $response->data = $data->orderBy("name")->get();
        return response()->json($response);
    }
    public function block($id){
        $response = $this->setIsActive($id, false);
        return response()->json($response);
    }
    public function unblock($id){
        $response = $this->setIsActive($id, true);
        return response()->json($response);
    }
    private function setIsActive($id, $is_active){
        $response = json_decode("{}");
        $data = Client::find($id);
        if ($data != null){
            try {
                $data->is_active = $is_active;
                $data->updated_dt = date('Y-m-d H:i:s');
                $data->updated_by = $request->input("user_id");
                $data->save();

                $response->status = true;
                $response->messages = [];
            } catch (\Illuminate\Database\QueryException $e) {
                $response->status = false;
                $response->messages = $e->errorInfo;
            }
        }else{
            $response->status = false;
            $response->messages = ["Client with ID '".$id."' is not found"];
        }
        return $response;
    }
    public function changePassword(Request $request, $id){
        $response = json_decode("{}");
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
            'user_id' => 'required|integer'
        ], $this->validatorMessages);

        if ($validator->fails()) {
            $response->status = false;
            $response->messages = $this->generateMessageArray($validator->errors());
        }else{
            $data = Client::find($id);
            if ($data != null){
                if (sha1($request->input("new_password")) != sha1($request->input("confirm_password"))){
                    $response->status = false;
                    $response->messages = ["New Password and Confirm Password is didn't match."];
                }else if ($data->password != sha1($request->input("password"))){
                    $response->status = false;
                    $response->messages = ["Current password is didn't match."];
                }else{
                    try {
                        $data->password = $request->input("new_password");
                        $data->updated_dt = date('Y-m-d H:i:s');
                        $data->updated_by = $request->input("user_id");
                        $data->save();
        
                        $response->status = true;
                        $response->messages = [];
                    } catch (\Illuminate\Database\QueryException $e) {
                        $response->status = false;
                        $response->messages = $e->errorInfo;
                    }
                }
            }else{
                $response->status = false;
                $response->messages = ["Client with ID '".$id."' is not found"];
            }
        }
        return response()->json($response);
    }
    public function auth(Request $request){
        $response = json_decode("{}");
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:25',
            'password' => 'required|string|min:8'
        ], $this->validatorMessages);

        if ($validator->fails()) {
            $response->status = false;
            $response->messages = $this->generateMessageArray($validator->errors());
        }else{
            try {
                $isExists = Client::where("email", $request->input("email"))
                    ->where("password", sha1($request->input("password")))->count() == 1;
                if ($isExists){
                    $response->status = true;
                    $response->messages = [];
                }else{
                    $response->status = false;
                    $response->messages = ["Authentication failed."];
                }
            } catch (\Illuminate\Database\QueryException $e) {
                $response->status = false;
                $response->messages = $e->errorInfo;
            }
        }
        return response()->json($response);
    }
}
