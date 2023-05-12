<div wire:init="loadPost">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">


        <!---Table---->

        <x-table>
            <div class="px-6 py-4 flex items-center">

                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select class="mx-2 form-control" wire:model="cant">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                </div>
                <div class="flex items-center">
                    <span>Movimiento</span>
                    <select class="mx-2 form-control" wire:model="movimiento">
                        <option value="seguro">Seguro</option>
                        <option value="parcela">Parcela</option>
                        <option value="certificado">Certificado</option>
                    </select>
                </div>

                <div class="flex items-center">
                    <span>Categorias</span>
                    <select class="mx-2 form-control" wire:model="categories">
                        <option value="Atra. 91-180">Atra. 91-180</option>
                        <option value="Normales">Normales</option>
                    </select>
                </div>
                <!-- input type="text" wire:model="search"> -->
                <!-- usando componentes de jetstream -->
                <x-input type="text" wire:model="search" class="flex-1 mx-4" placeholder="Escriba que quiere buscar" />



            </div>

            <!-- mostrar solo si encuentra un post -->
            @if(count($datos))
            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-green-300">

                    <tr>

                        <th scope="col" class="w-120 cursor-pointer px-12 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')">

                            Cliente

                        </th>

                        <th scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('content')">

                            Cedula Nro.

                        </th>

                        <th scope="col" class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('contrato.contrato')">

                            Contrato


                        </th>

                        <th scope="col" class="w-120 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')">

                            Operador

                        </th>

                        <th scope="col" class="w-120 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')">

                            Usuario

                        </th>
                        <th scope="col" class="w-120 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')">

                            Comentario

                        </th>
                        <th scope="col" class="w-120 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')">

                            Categoria

                        </th>

                        <th scope="col" class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('suma_cuotas_vencidas')">

                            Deuda



                        </th>

                        <th scope="col" class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('suma_cuotas_vencidas')">

                            Extracto de Cta.



                        </th>
                    </tr>

                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($datos as $dato)


                    <tr>

                        <td class="px-6 py-4">

                            {{ $dato->cliente}}


                        </td>


                        <td class="px-6 py-4">

                            @livewire('listar-contratos',['dato' => $dato->id_cliente , 'ci' => $dato->cedula , 'nombres' => $dato->cliente], key($dato->id_contrato))

                        </td>

                        <td class="px-6 py-4">

                            {{ $dato->contrato }}


                        </td>
                        <td class="px-6 py-4">

                            {{ $dato->operador  }}


                        </td>

                        <td class="px-6 py-4">

                            {{ $dato-> usuario}}


                        </td>

                        <td class="px-6 py-4">

                            <button> Ver </button>
                           

                        </td>


                        <td class="px-6 py-4">

                        {{$dato->categoria}}


                        </td>

                        <td class="px-6 py-4">

                            {{ $dato->a_pagar}}


                        </td>
                        <td class="px-6 py-4">

                            <a href="http://190.104.168.219/jparaiso/cp/extracta.php?id={{ $dato->id_contrato }}">Ver Extracto</a>



                        </td>
                    </tr>


                    @endforeach
                </tbody>

            </table>

            @if($datos->hasPages())
            <!-- paginacion  -->
            <div class="px-6 py-3">
                {{$datos->links()}}
            </div>
            @endif
            @else
            <div class="px-6 py-4">
                No existe ningun registro coincidente
            </div>
            @endif
            <!-- el metodo haspage permite preguntar cuantas paginas tiene -->

        </x-table>
    </div>


</div>