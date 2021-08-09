@extends('layouts.app')

@section('content')

<div id="new1">
    <table class="table table-hover">

        <thead>
        <tr>
            <th>variant</th>
            <th>stock </th>
        </tr>
        </thead>
        <tbody>

{{--        @foreach($data as $row)--}}
{{--            <tr >--}}
{{--                <td>{{ $row->variant}}</td>--}}
{{--                <td>{{ $row->stock }}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}

        <tr v-for="(row,index,key) in $data">
            <td>@{{ row.variant }}</td>
            <td>@{{ row.stock }}</td>

        </tr>
        </tbody>

    </table>
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    window.onload = function (){
        var v = new Vue({
            el:'#new1',
            data:{
                filedata:{},
            },

            methods:{
              getData:function (){
                axios.get('/view/new').then((res)=>{
                    console.log(res.data);
                    this
                }).catch((error)=>{

                })
              }
            }

        })
    }
</script>
