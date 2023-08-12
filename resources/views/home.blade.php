@extends('layouts.vitamina-web-admin')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Pesquisar Oportunidades de Venda</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">              
              <div class="collapse navbar-collapse" id="navbarSupportedContent">                
                <form action="{{ route('home') }}" method="get" class="d-flex" >
                  

                    

                  {{-- SELECT2 para pesquisar vendedor (user_id) --}}                    
                  <select class="form-control me-2 mr-3"  name="user_id" id="user_id" style="width: 550px;">  
                    
                    {{-- O valor escolhido e submetido via GET para vendedor (user_id) deve ser inicialmente selecionado. Para o Select2 V4, basta incluir o option selecionado abaixo  --}}                    
                    @if ($request_has_user_id)
                        <option value="{{ $request_has_user_id->id }}" selected="selected">{{ $request_has_user_id->name }}</option>    
                    @endif                    

                  </select>                  


                  <input class="form-control me-2 ml-3 mr-3" type="text" name="created_at_DE" id="created_at_DE" placeholder="De" aria-label="De" value="{{ request()->input('created_at_DE') }}">                  
                  <input class="form-control me-2 mr-3" type="text" name="created_at_ATE" id="created_at_ATE" placeholder="Até" aria-label="Até" value="{{ request()->input('created_at_ATE') }}">                  
                                                        
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
          </nav>

        <!-- /.col-lg-12 --> 
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="white-box">                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hove">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">#</th>
                                    <th class="border-top-0" scope="col">Cliente</th>
                                    <th class="border-top-0" scope="col">Vendedor</th>
                                    <th class="border-top-0" scope="col">Data</th>
                                    <th class="border-top-0" scope="col">Situação</th>
                                    <th class="border-top-0" scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$oportunidades->isEmpty())               
                                    @foreach ($oportunidades as $oportunidade)
                                        <tr>
                                            <th scope="row">{{$oportunidade->id}}</td>
                                            <td>{{$oportunidade->cliente_id}}</td>
                                            <td>{{$oportunidade->user_id}}</td>
                                            <td>{{ date('d/m/Y H:i:s', strtotime($oportunidade->created_at)) }}</td> 
                                            <td>{{$oportunidade->status}}</td>
                                            <td><a class="btn btn-outline-success">btn1</a><a class="btn btn-outline-success">btn2</a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <br>    
                                    <tr>
                                        <td colspan="6" class="text-center"><p class="font-weight-bold">Nenhum registro encontrado</p></td>    
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                        <div>
                            {{ $oportunidades->links() }} 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
       

@endsection

@push('js-scripts')
    
    <script type="application/javascript">            

        $(document).ready(function() {                       

            $('#created_at_DE').datepicker({            
                dateFormat: 'dd/mm/yy',                
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
            }); 

            $('#created_at_ATE').datepicker({            
                dateFormat: 'dd/mm/yy',                
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
            });  


            $('#user_id').select2({                
                placeholder: 'Pesquise um vendedor',  
                allowClear: true,              
                theme: 'bootstrap-5',   
                ajax: {
                url: "{{ route('autocompletevendedor') }}",
                dataType: 'json',
                delay: 220,
                processResults: function (data) {
                    return {
                    results:  $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
                }
            });

            
            


        });

    </script>
@endpush