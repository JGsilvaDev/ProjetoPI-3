@extends('layouts.main')

@section('title', 'Data Find')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" ></script>

    <header>

        <div class="md-3" id="divPais">
            <label>
                FILTROS
                <a class="float-start" href="\" id="img-home">
                    <img src="img/events/icons-home.svg" height="30" alt="Icone para home">
                </a>
                <a class="btn btn-link float-end" href="\lixo" role="button" id="reload"><i class='bx bx-arrow-back bx-md' 
                    style='color:#ffffff'></i></a>
            </label>
            <label>
                <form method="GET" action="/lixo" id="formChart">
                    @csrf
            
                        <select name="Capitais" id = "Capitais" size="1" width="195" tabindex="1">
                            <option value="-1" selected>Selecione uma Capital</option>
                            @foreach ($capitaisName as $cap)
                                <option data-TipoTabela="{{ $cap->Nome_tabela }}" value="{{ $cap->Nome_Capitais }}">
                                    {{ $cap->Nome_Capitais }}</option>
                            @endforeach
                        </select>

                        <select name="TipoGraficos" id = "TipoGrafico" size="1" width="195" tabindex="1">
                            <option value="-1"selected>Selecione um tipo de grafico</option>
                            <option value="bar">Graficos de Barras</option>
                            <option value="line">Graficos de Linha</option>
                            <option value="bubble">Graficos de Bolha</option>
                            <option value="doughnut">Graficos de Donuts</option>
                            <option value="pie">Graficos de Pizza</option>
                            <option value="polarArea">Graficos Polas</option> 
                            <option value="radar">Graficos de Radar</option>    
                        </select>
                    </div> 

                    <div class="form-group" >
                        <select name="TipoTabela" id = "TipoTabela">
                            <option value="-1" selected>Selecione um tipo de dado a ser filtrado</option>
                            @foreach ($dados as $dado)
                                <option value="{{ $dado->nome_tabelas }}">{{ $dado->nome_tabelas }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-outline-dark" onclick="updateChart()" id="botaoPesquisar"><i class='bx bx-search'
                            style='color:#ffffff'></i></button>
                    </div>

                    <input type="hidden" name="teste" value="1">

                    <div class="pt-2">
                        <button type="button" class="btn btn-primary btn-sm" onclick="addValue()" id="botaoAdicionar">ADICIONAR</button>
                        <button type="button" class="btn btn-info btn-sm" onclick="addGrafico()" id="botaoGrafico" 
                                style='color:#ffffff'>MUDAR GRAFICO</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="popValue()" id="botaoPop">REMOVER</button>

                    </div>
                        <select name="Dados" id = "Dados" size="1" width="195" tabindex="1">
                            @foreach ($total as $tot)
                                <option data-Capitais="{{ $tot->Nome_Capitais }}" data-TipoTabela="{{ $tot->Nome_tabela }}" value="{{ $tot->Total }}"> {{ $tot->Total }}</option>
                            @endforeach
                        </select>
                </form>     
            </label>
        </div>
    </header>

    <div class="col-md-7 offset-md-3 mx-auto mt-3" >
        <div class="card">
            <div clas="card-body">
                <h4 id="nomeGrafico"> Grafico </h4>
            </div>
            <div clas="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        
    </div>
               
    </body>
    
        <footer>
        
        </footer>
        

        <script>
            $("#formChart").on( "submit", function(e) {
            
            var dataString = $("#TipoTabela").val();
            var capitais = $("#Capitais").val();

            console.log('AJAX mandando datastring= ' + dataString+ ' e capitais = ' + capitais)

            $.ajax({
            type: "GET",
            url: "lixo",
            data: {
                "_token": "{{ csrf_token() }}",
                "dataString":dataString,
                "capitais":capitais,
            },
            success: function () {
              console.log('sucesso');
            }
            });
            e.preventDefault();
            });
        </script>


        <script type="text/javascript">

            $("#Dados").hide();
            $("#botaoAdicionar").hide();
            $("#botaoPop").hide();
            $("#reload").hide();
            $("#Capitais").hide();
            $("#TipoGrafico").hide();
            $("#botaoGrafico").hide();

            var capitais = $('select[name="Capitais"] option');
            var dados = $('select[name="Dados"] option');
            var regioes = $('select[name="Regioes"] option');

            $('select[name="TipoTabela"]').on('change', function() {
                var tipoTabela = this.value;
                var novoSelect = capitais.filter(function() {
                    return $(this).data('tipotabela') == tipoTabela;
                });
                $('select[name="Capitais"]').html(novoSelect);
            });

            $('select[name="Capitais"]').on('change', function() {
                var capitais = this.value;
                var tipoTabela =  $("#TipoTabela").val();
                var novoSelect = dados.filter(function() {
                    return $(this).data('capitais') == capitais & $(this).data('tipotabela') == tipoTabela;
                });
                console.log(capitais,tipoTabela);
                $('select[name="Dados"]').html(novoSelect);
            });


        </script>
        
        <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
        <!-- Chartisan -->
        <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
        <!-- Your application script -->

        <!-- Charting library -->
        <script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
        <!-- Chartisan -->
        <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

        <!-- Charts Js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        

        <script>
            const exemplo = [5, 10, 5, 2, 20];
            
            const ctx = document.getElementById('myChart').getContext('2d');
            const chart = new Chart(ctx, {
                type:'bar',
                data: {
                    labels: ['January','February','March','April','May'],                        
                    datasets: [{
                        label: 'Exemplo',
                        backgroundColor: ['rgb(255, 255, 0)',  
                                          'rgb(51, 51, 255)',
                                          'rgb(255, 128, 0)',
                                          'rgb(153, 73, 0)',
                                          'rgb(128, 128, 128)',
                                          'rgb(76, 0, 153)',
                                          'rgb(0, 255, 0)',
                                          'rgb(255, 0, 0)'],
                        borderColor: ['rgb(255, 255, 0)',  
                                          'rgb(51, 51, 255)',
                                          'rgb(255, 128, 0)',
                                          'rgb(153, 73, 0)',
                                          'rgb(128, 128, 128)',
                                          'rgb(76, 0, 153)',
                                          'rgb(0, 255, 0)',
                                          'rgb(255, 0, 0)'],
                        data: exemplo ,
                    }]
                }, 

                options: {
                    legend: {
                    display: false
                    }
                }
            });

            

            function updateChart(){

                var selectRegiao = $("#Regioes").val();
                var selectCapitais = $("#Capitais").val();
                var selectFiltro = $("#TipoTabela").val();
                var selectDados = $("#Dados").val();
                var selectD = selectDados.replace(",",".");
                var selectGrafico = $("#TipoGrafico").val();

                if(selectCapitais < 0 || selectFiltro < 0 || selectGrafico < 0 ){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Por favor selecione os filtros',
                        })
                }else{

                    $("#nomeGrafico").text(selectFiltro);
                    $("#TipoTabela").hide();
                    $("#botaoPesquisar").hide();
                    $("#botaoAdicionar").show();
                    $("#botaoPop").show();
                    $("#reload").show();
                    $("#botaoGrafico").show();    

                    if(selectFiltro == "Coeficiente de variacao - Domicilios com lixo coletado por servico de limpeza (%)"){
                        chart.config.type = [selectGrafico];
                        chart.data.datasets[0].data = [selectD];
                        chart.data.labels = [selectCapitais];
                        chart.data.datasets[0].label = ["Coeficiente de variação - Domicilios com lixo"];
                        chart.update();

                    }else if(selectFiltro == "Coeficiente de variacao - Percentual de domicilios com lixo coletado por servico de limpeza (%)"){
                        chart.config.type = [selectGrafico];
                        chart.data.datasets[0].data = [selectD];
                        chart.data.labels = [selectCapitais];
                        chart.data.datasets[0].label = ["Coeficiente de variação - Percentual de domicilios"];
                        chart.update();

                    }else if(selectFiltro == "Domicilios com lixo coletado por serviio de limpeza (Mil domicilios)"){
                        chart.config.type = [selectGrafico];
                        chart.data.datasets[0].data = [selectD];
                        chart.data.labels = [selectCapitais];
                        chart.data.datasets[0].label = ["Domicilios com lixo coletado"];
                        chart.update();

                    }else if(selectFiltro == "Domicilios com lixo coletado por servico de limpeza, considerando um intervalo de confianca de 95% - limite inferior (Mil domicilios)"){
                        chart.config.type = [selectGrafico];
                        chart.data.datasets[0].data = [selectD];
                        chart.data.labels = [selectCapitais];
                        chart.data.datasets[0].label = ["Domicilios com lixo coletado, considerando o limite inferior"];
                        chart.update();

                    }else if(selectFiltro == "Percentual de domicilios com lixo coletado por servico de limpeza (%)"){
                        chart.config.type = [selectGrafico];
                        chart.data.datasets[0].data = [selectD];
                        chart.data.labels = [selectCapitais];
                        chart.data.datasets[0].label = ["Percentual de domicilios com lixo coletado"];
                        chart.update();

                    }else if(selectFiltro == "Percentual de domicilios com lixo coletado por servico de limpeza, considerando um intervalo de confianca de 95% - limite inferior (%)"){
                        chart.config.type = [selectGrafico];
                        chart.data.datasets[0].data = [selectD];
                        chart.data.labels = [selectCapitais];
                        chart.data.datasets[0].label = ["Percentual de domicilios com lixo coletado, considerando o limite inferior"];
                        chart.update();

                    }else if(selectFiltro == "Percentual de domicilios com lixo coletado por servico de limpeza, considerando um intervalo de confianca de 95% - limite superior (%)"){
                        chart.config.type = [selectGrafico];
                        chart.data.datasets[0].data = [selectD];
                        chart.data.labels = [selectCapitais];
                        chart.data.datasets[0].label = ["Percentual de domicilios com lixo coletado, considerando o limite superior"];
                        chart.update();
                    }
                    
                }  
            };

            function addValue(){

                var selectRegiao = $("#Regioes").val();
                var selectCapitais = $("#Capitais").val();
                var selectFiltro = $("#TipoTabela").val();
                var selectDados = $("#Dados").val();
                var selectD = selectDados.replace(",",".");

                console.log(selectD);
                chart.data.datasets[0].data.push(selectD);
                chart.data.labels.push(selectCapitais);
                chart.update();
            }

            function popValue(){
                chart.data.datasets[0].data.pop();
                chart.data.labels.pop();
                chart.update();
            }

            function addGrafico(){
                var selectGrafico = $("#TipoGrafico").val();

                chart.config.type = [selectGrafico];
                chart.update();
            }


        </script>

        <script>
            $('select[name="TipoTabela"]').on('click',function(){
                $("#Capitais").show();
            });

            $('select[name="Capitais"]').on('click',function(){
                $("#TipoGrafico").show();
            });
        </script>
  


    @endsection
