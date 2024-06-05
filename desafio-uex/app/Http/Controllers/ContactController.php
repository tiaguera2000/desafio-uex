<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{

            $perPage = $request->get("perPage", 10);
            $page = $request->get("page", 1);
            $total = $request->get("total", 20);
            $contacts = Contact::where(["user_id" => Auth::user()->id])->orderBy("name", "ASC");
            return response(["success" => true, "contacts" => $contacts->simplePaginate(10)], 200);
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{

            return view("contact.create");
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        try{

            DB::beginTransaction();
            $address = Address::create($request->all());
            if(!$address) throw new Exception("Erro ao criar endereço.");
            $request->merge(["user_id" => Auth::user()->id, "address_id" => $address->id]);
            $contact = Contact::create($request->all());
            if(!$contact) throw new Exception("Erro ao criar contato.");
            DB::commit();
            return redirect()->route("home")->with("success", "contato cadastrado com sucesso.");
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        try{

        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        try{

            return view("contact.edit", ["contact" => $contact]);
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        try{

            $contact->update($request->all());
            $address = Address::find($contact->address_id);
            $address->update($request->all());
            return redirect()->route("home")->with("success", "Contato atualizado com sucesso.");
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        try{
            DB::beginTransaction();
            $address = Address::find($contact->address_id);
            $contact->delete();
            $address->delete();
            DB::commit();
            return redirect()->route("home")->with("success", "Contato excluído com sucesso.");
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
