<template>
    <h1>
        Product
    </h1>
    <p>{{ name}}</p>

</template>

<script>
    export default {
        name: 'ProductVue',
        props: ['name'],

    }

</script>