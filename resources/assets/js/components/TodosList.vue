<template>

    <div>
        <p v-show="seen">{{ message }}</p>
        <input type="text" model="message">
        <button v-on:click="reverseMessage">Reverse</button>

        <ol>
            <li v-for="todo in todos"> {{ todo.name }} | {{ todo.priority }} | {{ todo.done }}</li>
        </ol>
    </div>
</template>

<style>

</style>

<script>
     export default {
         data(){
            return {
                message: 'Hello Vue que tal!',
                seen: false,
                todos: [],
            }
         },
         methods: {
            reverseMessage:function () {
                this.message= this.message.split('').reverse().join('');
            },
            fetchData: function() {
                console.log('hola');
            // GET /someUrl
                this.$http.get('/api/v1/task').then((response) => {
                    this.todos = response.data.data;
                    console.log(response);
                }, (response) => {
            // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
         },
         created: function() {
            console.log('Component created!');
            this.fetchData()

         }



     }
 </script>

<!--data: {-->
<!--message: 'Hello Vue que tal!',-->
<!--seen: false,-->
<!--todos: []-->
<!--},-->
<!--methods: {-->
<!--reverseMessage:function () {-->
<!--this.message= this.message.split('').reverse().join('');-->
<!--},-->
<!--fetchData: function() {-->
<!--console.log('hola');-->
<!--// GET /someUrl-->
<!--this.$http.get('/api/v1/task').then((response) => {-->
<!--this.todos = response.data.data;-->
<!--console.log(response);-->
<!--}, (response) => {-->
<!--// error callback-->
<!--sweetAlert("Oops...", "Something went wrong!", "error");-->
<!--console.log(response);-->
<!--});-->
<!--},-->

<!--},-->
<!--created: function() {-->
<!--console.log('Component created!');-->
<!--this.fetchData()-->

<!--}-->