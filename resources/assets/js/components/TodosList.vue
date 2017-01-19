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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <todo v-for="(todo, index) in filteredTodos"
                              v-bind:todo="todo"
                              v-bind:index="index"
                              v-bind:from="from"
                              v-bind:page="page"
                              v-bind:fetchPage="fetchPage"
                              @todo-deleted="deleteTodo"> </todo>
                    </tbody>

                </table>
            </div>
            <!-- /.box-body -->
            <!--TODO http://www.pontikis.net/labs/bs_pagination/demo/-->
            <div class="box-footer clearfix">
                <span class="pull-left">Showing {{ from }} to {{ to }} of {{ total }} entries</span>

                <pagination
                        :current-page="page"
                        :items-per-page="perPage"
                        :total-items="total"
                        @page-changed="pageChanged"> </pagination>

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
                seen: false,
                todos: [],
                visibility: 'all',
                newTodo: '',
                perPage: 0,
                from: 0,
                to: 0,
                total: 0,
                page: 1,
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
            deleteTodo: function(id){
                var del = this;
                swal({
                  title: "Are you sure?",
                  text: "You will not be able to recover this task!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, delete it!",
                  closeOnConfirm: false
                },
                function(){
                    del.delTodoFromApi(id);
                    del.fetchPage(del.page);
                    swal("Deleted!", "Your task has been deleted.", "success");
                });

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
                this.todos.push(todo);
                this.addTodoToApi(todo);
                this.newTodo = '';
            },
            setVisibility: function(visibility) {
                this.visibility = visibility;
            },
            reverseMessage:function () {
                this.message= this.message.split('').reverse().join('');
            },
            fetchData: function() {
                return this.fetchPage(1);
            },
            addTodoToApi: function(page) {
                 this.$http.post('/api/v1/task?', {
                        name: todo.name,
                        priority: todo.priority,
                        done: todo.done,
                        user_id: todo.user_id,
                 }).then((response) => {
                    console.log('Task with name \"' + todo.name + '\" created succesfully!');
                 }, (response) => {
                    // error callback
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                 });
                 this.fetchPage(this.page);
            },
            pageChanged: function(pageNum) {
                this.page = pageNum;
                this.fetchPage(pageNum);
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
            delTodoFromApi: function(id) {
                this.$http.delete('/api/v1/task/' + id).then((response) => {
                    console.log('Task ' + id + ' deleted succesfully!');
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            }
         },
         created: function() {
            console.log('Component created!');
            this.fetchData();
         }



     }
 </script>
