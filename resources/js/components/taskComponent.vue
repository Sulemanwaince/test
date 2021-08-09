<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Task Component</div>

                    <div class="card-body">
                        I'm an Task component.
                    </div>
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Variant</th>
                            <th>Stock</th>

                        </tr>
                        <tr v-for="user in filedata" : key="user.id">
                            <td>{{user.variant}}</td>
                            <td>{{user.stock}}</td>


                        </tr>


                        </tbody></table>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data(){
      return {
          filedata : {},
          form: new Form({
              variant : '',
              stock :'',
          })
      }

    },
    methods:{
      loadFile(){
        axios.get("api/user").then(({data}) => (this.filedata = data.data));
      },
    },
    mounted() {

        this.loadFile();
    }
}
</script>
