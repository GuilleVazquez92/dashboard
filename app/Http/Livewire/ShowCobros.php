<?php

namespace App\Http\Livewire;



use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

use Livewire\Component;
use Livewire\WithPagination;

class ShowCobros extends Component
{

    use WithPagination;
    public $sort = 'clientes.nombres';
    public $direction= 'desc';
    public $cant = 10;
    public $search ='';
    public $categories= 'Atra. 91-180';
    public $readyToLoad = false;
    public $movimiento = 'parcela';
 
  

    protected $queryString = [
        'cant'=>['except'=> '10'],
        'sort'=>['except'=> 'clientes.nombres'],
        'direction'=>['except'=> 'desc'],
        'categories' =>['except' => 'Atra. 91-180'],
        'search'=>['except'=> ''],
        'movimiento' => ['except' => 'parcela']
    ];


    public function mount()

    {
        $this->sort = 'clientes.nombres';
        $this->direction= 'desc';
        $this->cant = 10;
        $this->search ='';
        $this->categories= 'Atra. 91-180';
        $this->readyToLoad = true;
        $this->movimiento = 'parcela';
      
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    protected $listeners = ['render'];


    public function render()
    {


        if($this->readyToLoad){
           
            $datos = DB::TABLE('dash_tablero')
             ->select('*' )
             ->where('dash_tablero.categoria','=', $this->categories)
             ->where('dash_tablero.producto','=', $this->movimiento)
             ->where('dash_tablero.contrato','like','%'. $this->search . '%')
            ->paginate($this->cant);
       
        }
        else{
            $datos = [];
        }


        return view('livewire.show-cobros', compact('datos'));
    }


    
    public function loadPost()
    {
        $this->readyToLoad = true;
    }

    // odernar post 
    public function order($sort)
    {
        if ($this->sort == $sort) {
            
            if ($this->direction == 'desc') {
                
                $this->direction = 'asc';
                
            } else {
                $this->direction = 'desc';
            }
            

        } else {
            $this->sort= $sort;
            $this->direction = 'asc';
        }
    }

    public function listContrat($id)
    {
      
       $selectUser = db::table('contratos')
        ->join('clientes','contrato.idcliente','=','clientes.idclientes')
        ->select('idcontrato', 'contrato', 'clientes.nombres', 'clientes.apellidos')
                            ->where('contrato.clientes','=', $id);

    }
}
