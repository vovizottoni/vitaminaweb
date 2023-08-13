@extends('layouts.vitamina-web-admin')

@section('content')
    
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <h4 class="page-title">Cadastrar Oportunidade de Venda</h4> 
        </div>        
    </div>

    <div class="container-fluid">                        
        <div class="row">                                           
            <div class="col-lg-12 col-xlg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('oportunidade-store') }}" method="POST" class="form-horizontal form-material">

                            @csrf 

                            <div class="form-group mb-3">
                                <label class="col-md-12 p-0 label-form-bold">Vendedor</label>
                                <div class="col-md-12 border-bottom p-0">
                                    {{ Auth::user()->name }}
                                </div>
                            </div>

                            
                            <div class="form-group mb-4">
                                <label class="col-md-12 col-sm-12 col-xs-12 p-0 label-form-bold">Selecione o Cliente</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 border-bottom p-0">
                                    
                                    {{-- SELECT2 para pesquisar clientes --}}                    
                                    <select class="form-control p-0 @error('cliente_id') is-invalid @enderror"  name="cliente_id" id="cliente_id" style="min-width: 230px;">  
                                        @if (old('cliente_id'))                                            
                                            <option value="{{ old('cliente_id') }}" selected="selected">{{ App\Models\Cliente::where(['id' => old('cliente_id')])->first()->nome }}</option>                                            
                                        @endif
                                    </select>   
                                    
                                    @error('cliente_id')
                                        <div class="alert alert-danger">{{ $message }}</div> 
                                    @enderror
                                    
                                </div>
                            </div>                           
                                                        
                            <div class="form-group mb-3">
                                <label class="col-md-12 col-sm-12 col-xs-12 p-0 label-form-bold">Selecione o(s) Produto(s)</label>
                                <div class="col-md-12 col-sm-12 col-xs-12 border-bottom p-0">
                                    
                                    {{-- SELECT2 MULTIPLE para pesquisar produtos --}}                    
                                    <select class="form-control p-0 @error('produtos_id') is-invalid @enderror"  name="produtos_id[]" multiple id="produtos_id" style="min-width: 230px;">
                                        @if (is_array(old('produtos_id')))
                                            @foreach (old('produtos_id') as $produto_id)
                                                <option value="{{ $produto_id }}" selected="selected">{{ App\Models\Produto::where(['id' => $produto_id ])->first()->nome }}</option> 
                                            @endforeach 
                                        @endif     
                                    </select> 
                                    
                                    @error('produtos_id') 
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                </div>
                            </div>                            

                            <div class="row">                                
                                <div class="col-md-1 col-sm-12 col-xs-12 p-0 mb-2">
                                    <button type="submit" class="btn btn-success">Cadastrar</button> 
                                </div>
                                <div class="col-md-1 ml-md-n5 col-sm-12 col-xs-12  p-0  mb-2">
                                    <a href="{{ route('home') }}" class="btn btn-secondary btn-md text-white">Voltar</a>
                                </div>                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>                    
        </div>
        
    </div>
            



@endsection

@push('js-scripts') 
    
    <script type="application/javascript">            

        $(document).ready(function() {                       
            
            
            $('#cliente_id').select2({                  
                placeholder: 'Pesquise um cliente',  
                allowClear: true,              
                theme: 'bootstrap-5',   
                ajax: {
                url: "{{ route('autocompletecliente') }}",
                dataType: 'json',
                delay: 220,
                processResults: function (data) {
                    return {
                    results:  $.map(data, function (item) {
                            return {
                                text: item.nome,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
                }
            });

            
            $('#produtos_id').select2({         
                tags: true,
                tokenSeparators: [','],          

                multiple: true,   //MULTIPLE OPTIONS :)                 
                placeholder: 'Pesquise produto(s)',  
                allowClear: true,              
                theme: 'bootstrap-5',   
                ajax: {
                url: "{{ route('autocompleteprodutos') }}",
                dataType: 'json',
                delay: 220,
                processResults: function (data) {
                    return {
                    results:  $.map(data, function (item) {
                            return {
                                text: item.nome,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true 
                }
            });

            //Se retornou a esta página por erros de validate e tem old('produtos_id'), entao adicionar esses optios via Jquery 


        });

    </script>
@endpush