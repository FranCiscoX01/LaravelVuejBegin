<template>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Contenido</th>
                <th scope="col">Precio</th>
                <th scope="col">PDF</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="s in show" :key="s">
                <th scope="row">{{ s.id }}</th>
                <td>{{ s.name }}</td>
                <td>{{ s.content }}</td>
                <td>{{ s.price }}</td>
                <td><a href=""><button type="button" class="btn btn-info">PDF</button></a></td>
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
