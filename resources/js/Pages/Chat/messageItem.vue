<template>
    <div>
        {{ message.user.name}}: {{ message.message }} 
    </div>
</template>


<script>
    export default {
        props: ['message', 'index']
    };
</script>
