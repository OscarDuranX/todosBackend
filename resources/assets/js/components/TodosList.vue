<template>
<div>
        <div class="box">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Task</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="#">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" class="form-control" id="name" placeholder="Enter task name here"
                                   v-model="newTodo"
                                   @keyup.enter="addTodo">
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-header with-border">
                <h3 class="box-title">Tasques</h3>

                <div class="btn-group">
                    <button type="button" class="btn btn-info">{{visibility}}</button>
                    <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" v-on:click="setVisibility('all')">All</a></li>
                        <li><a href="#" v-on:click="setVisibility('active')">Active</a></li>
                        <li><a href="#" @click="setVisibility('completed')">Done</a></li>
                    </ul>
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">

                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Task</th>
                        <th>Priority</th>
                        <th>Done</th>
                        <th>Progress</th>
                        <th style="width: 40px">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(todo, index) in filteredTodos">
                        <td>{{index + 1}}</td>
                        <td>{{todo.name}}</td>
                        <td>{{todo.priority}}</td>
                        <td>{{todo.done}}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                            </div>
                        </td>
                        <td><button type="button" class="btn btn-default btn-sm"
                                    v-on:click="deleteTask(index)">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
            <!-- /.box-body -->
            <!--TODO http://www.pontikis.net/labs/bs_pagination/demo/-->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
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
                visibility: 'all',
                newTodo: ''
            }
         },

         computed: {
            filteredTodos: function(){
                var filters = {
                    all: function(todos){
                        return todos;
                    },
                    active: function(todos){
                        return todos.filter(function(todo){
                            return !todo.done;
                        });
                    },
                    completed: function(todos){
                         return todos.filter(function(todo){
                            return todo.done;
                         });
                    },
                };

                return filters[this.visibility](this.todos);
            }
         },

         methods: {
            deleteTask: function(index){
                this.todos.splice(index, 1);

            },
            addTodo: function() {
                var value = this.newTodo && this.newTodo.trim();
                if (!value) {
                    return;
                }
                this.todos.push({
                    name: value,
                    priority: 1,
                    done: false
                });
                this.newTodo = '';
            },
            setVisibility: function(visibility) {
                console.log(visibility);
                this.visibility = visibility;
            },
            reverseMessage:function () {
                this.message= this.message.split('').reverse().join('');
            },
            fetchData: function() {
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
            this.fetchData();
         }



     }
 </script>
