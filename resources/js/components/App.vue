<template>
    <div id="app">
        <div class="cruds">
            <div class="cruds__title text-center">Cruds</div>
            <div>
                <button class="btn-add btn btn-primary" @click="create">Add</button>
            </div>
            <crud-component
                v-for="crud in cruds"
                v-bind="crud"
                :key="crud.id"
                @update="update"
                @delete="del"
            ></crud-component>
        </div>
    </div>
</template>
<script>
    function Crud({ id, color, name}) {
        this.id = id;
        this.color = color;
        this.name = name;
    }

    import CrudComponent from './CrudComponent.vue';

    export default {
        components: {
            CrudComponent,
        },
        data() {
            return {
                cruds: [],
                mute: false,
            }
        },
        created() {
            this.read();
        },
        methods: {
            async create() {
                console.log('create');
                this.mute = true;
                window.axios.get('/api/crud/create').then((result) => {
                    this.cruds.push(new Crud(result.data));
                    this.mute = false;
                });
            },
            async read() {
                console.log('read');
                this.mute = true;
                window.axios.get('/api/crud').then((result) => {
                    this.cruds = result.data;
                    this.mute = false;
                });
            },
            async update(id, color) {
                console.log('update');
                this.mute = true;
                await window.axios.put(`/api/crud/${id}`, { color });
                // Once AJAX resolves we can update the Crud with the new color
                this.cruds.find(crud => crud.id === id).color = color;
                this.mute = false;
            },
            async del(id) {
                console.log('delete');
                this.mute = true;
                await window.axios.delete(`/api/crud/${id}`);
                let index = this.cruds.findIndex(crud => crud.id === id);
                this.cruds.splice(index, 1);
                this.mute = false;
            }
        },
        watch: {
            mute(val) {
                document.getElementById('mute').className = val ? "on" : "";
            }
        },
    }
</script>
