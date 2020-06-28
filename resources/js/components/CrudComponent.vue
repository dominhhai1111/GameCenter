<template>
    <div class="crud d-flex p-2">
        <div class="left-block">
            <img class="avatar" :src="image"/>
        </div>
        <div class="right-block w-75">
            <div class="item__name">Name: {{ name | properCase }}</div>
            <div class="item__actions d-flex align-items-center">
                <select class="select-color form-control d-inline" @change="update">
                    <option
                        v-for="col in [ 'red', 'green' ]"
                        :value="col"
                        :key="col"
                        :selected="col === color ? 'selected' : ''"
                    >{{ col | properCase }}
                    </option>
                </select>
                <button class="btn-delete btn btn-danger" @click="del">Delete</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        computed: {
            image() {
                return `/images/${this.color}.png`;
            }
        },
        methods: {
            update(val) {
                this.$emit('update', this.id, val.target.selectedOptions[0].value);
            },
            del() {
                this.$emit('delete', this.id);
            }
        },
        props: ['id', 'color', 'name'],
        filters: {
            properCase(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        }
    }
</script>
