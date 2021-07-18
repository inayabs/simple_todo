<template>
     <div class="container">
        <div class="row">
            <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom:10px;">
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control" placeholder="Search keyword" aria-describedby="btnGroupAddon" v-model="filter_key">
                            <div class="input-group-append">
                                <button class="btn btn-primary" @click="sertz()"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            All task
                        </div>
                        <div class="col-md-4 text-right">
                            <button class="btn btn-success btn-sm" @click="selectTask(null)" style="">
                                +
                            </button>
                        </div>
                        
                    </div>
                    <br>
                     <template v-if="tasks.length > 0">
                        <a href="javascript:void(0)" :class="'card card-body'" v-for="task in tasks" :key="task.id" @click="selectTask(task)">
                            {{task.task_title}} - {{task.category.name}}
                        </a>
                    </template>
                    <template v-else>
                        <div class="card card-body">
                            No Tasks Found
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <task-component :task="selected_task"/>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import taskComponent from './taskComponent';
    export default {
        components:{
            taskComponent
        },
        data(){
            return{
                filter_key:'',
                selected_task:null,
                tasks:[]
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.getTasks();
        },
        watch:{
            
        },
        methods:{
            sertz(){
                swal.fire({
                    title:'Loading please wait.',
                    didOpen:()=>{
                        swal.showLoading()
                    }
                });
                if(this.filter_key===''){
                    this.getTasks();
                    swal.close();
                }else{
                    axios.get(`/search/${this.filter_key}`).then(
                        response=>{
                            this.tasks = response.data;
                            swal.close();
                        }
                    );
                }                
            },
            selectTask(task){
                this.selected_task = task;
                this.$children[0].changeEvent = !this.$children[0].changeEvent;
            },
            getTasks(update = 0){
                axios.get('/task/get-tasks').then(
                    response=>{
                        this.tasks = response.data
                        if(response.data.length > 0){
                            this.selected_task = response.data[0];
                        }else{
                            this.selected_task = null;
                        }
                        this.$children[0].changeEvent = !this.$children[0].changeEvent;
                    }
                );
            }
        }
    }
</script>
