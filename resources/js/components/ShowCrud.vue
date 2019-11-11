<template>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Contenido</th>
                <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="s in show">
                <th scope="row">{{ s.id }}</th>
                <td>{{ s.name }}</td>
                <td>{{ s.content }}</td>
                <td>{{ s.price }}</td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    props: {
        show: Array,
    },
    data(){
        return {}
    }
}
</script>
