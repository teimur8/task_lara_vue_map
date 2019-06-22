<template>
    <center-wrapper :items="items"></center-wrapper>
</template>

<script>

    import CenterWrapper from './Wrapper'

    export default {
        props:['items'],
        components: {CenterWrapper}
    }
</script>

