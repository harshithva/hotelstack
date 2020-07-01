<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use App\Home;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home = Home::first();
        $expenses = Expense::orderBy('created_at', 'DESC')->get();
        $date = Carbon::now();
        $expenses->total = $this->getMonthlySum($date);
        $income = Payment::sum('amount');
        return view('backend.admin.expenses.index',compact('home',"expenses","income"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $categories = ExpenseCategory::all();
        return view('backend.admin.expenses.create',compact('categories'));
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
         'name'=> ['required','max:255'],
         'amount'=> ['required','max:255'],
         'category_id'=> ['required','max:255'],
     ]);
        // Expense::create(
        //     request() -> validate([
        //   'name'=> ['required','max:255'],
        //   'amount' => ['required','min:3']
        //  ])
        // );
        $expense = new Expense;
        $expense->name = $request->name;
        $expense->note = $request->note;
        $expense->category_id = $request->category_id;
        $expense->date = Carbon::createFromFormat('d/m/Y',$request->date);
        $expense->amount = $request->amount;
        $expense->save();
        
       
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->back();
    }

   public function getMonthlySum(Carbon $date)
    {
        $year = $date->year;
        $month = $date->month;

        if ($month < 10) {
            $month = '0' . $month;
        }

        $search = $year . '-' . $month;

        $sum = Expense::where('created_at', 'like', $search .'%')->sum('amount');

        return $sum;
    }
}
