<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
<div id="app">
    <div>
{{--        <task-form></task-form>--}}

        <form action="/tasks" method="post" @submit.prevent="addData()">
            <div class="form-group">
                <label for="exampleInputVariant">Variant</label>
                <input type="" v-model="variant" name="variant" class="form-control" id=""  placeholder=" variant">
            </div>
            <div class="form-group">
                <label for="exampleInputStock">Stock</label>
                <input type="text" v-model="stock" name="stock" class="form-control" id="" placeholder="stock">
            </div>

            <button type="submit" class="btn btn-primary">Add</button>

        </form>
        <br>
        <br>

    </div>
    <table class="table-responsive">
        <thead>
        <tr>
            <th>Variant</th>
            <th>Stock</th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="result in results">
                <td>@{{ result.variant }}</td>
                <td>@{{ result.stock }}</td>
                <td ><button @click="deleteData(result.variant)"> Delete</button></td>
            </tr>
        </tbody>
    </table>

</div>


<script>

    var app = new Vue({
        el: '#app',
        data: {
            results: [],

                variant:'',
                stock:''

        },
        // data(){

        // },
        methods: {
            fetchData() {
                axios.get('/tasks').then(res => {
                    this.results = res.data;
                })

            },
            deleteData(id){
                axios.delete('/tasks/'+id).then(res => {
                    this.fetchData();
                })
            },
            addData(){

                axios.post('/tasks',{
                    variant:this.variant ,
                    stock:this.stock
                }).then(res => {
                    this.fetchData();
                }).catch(function (error){
                    console.log(error);
                });
                alert('Data added ');
            }
        },

        mounted() {
            this.fetchData();
        }
    })
</script>
</body>
</html>
