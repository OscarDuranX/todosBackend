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
                    <todo v-for="(todo, index) in filteredTodos"
                          v-bind:todo="todo"
                          v-bind:index="index"
                          v-bind:from="from"
                          @todo-deleted="deleteTodo"></todo>

                    </tbody>

                </table>
            </div>
            <!-- /.box-body -->
            <!--TODO http://www.pontikis.net/labs/bs_pagination/demo/-->
            <div class="box-footer clearfix">ç

                <span class="pull-left">Showing {{ from }} to {{ to }} of {{ total }} entries</span>

                <pagination
                        :current-page="1"
                        :total-pages="perPage"
                        :total-items="total">

                </pagination>

            </div>
        </div>
</div>
</template>

<style>

</style>

<script>
import Pagination from './Pagination.vue'
import Todo from './Todo.vue'

     export default {

     components : { Pagination, Todo },
         data(){
            return {
                message: 'Hello Vue que tal!',
                seen: false,
                todos: [],
                visibility: 'all',
                newTodo: '',
                perPage: 5,
                from: 0,
                to: 0,
                total: 0
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
            addTodoToApi: function(page) {
             this.$http.post('/api/v1/task?', {
                    name: todo.name,
                    priority: todo.priority,
                    done: todo.done,
                    user_id: 1
                }).then((response) => {
                console.log(response);
            }, (response) => {
                // error callback
                sweetAlert("Oops...", "Something went wrong!", "error");
                console.log(response);
            });

            },

            fetchPage: function(page) {
            // GET /someUrl
            this.$http.get('/api/v1/task?page=' + page).then((response) => {
                console.log(response);
                this.todos = response.data.data;
                this.perPage = response.data.per_page;
                this.to = response.data.to;
                this.from = response.data.from;
                this.total = response.data.total;
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
