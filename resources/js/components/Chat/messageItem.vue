<template>
    <div>

        <div v-if="sentMessage">
            <div class="message sent_message">
                <div class="message__text">
                    {{ message.message }} 
                </div>
            </div>
        </div>

        <div v-else class="message recieved_message">
            <div class="message__author">
                <!-- {{ message.user.name[0]}} -->
            </div>

            <div class="message__text">
                {{ message.message }} 
            </div>
        </div>

    </div>
</template>


<script>
    export default {
        props: ['sentMessage', 'className', 'message', 'index']
    };
</script>

<style scoped>
    .message {
        margin: .25em;
        display: flex;
        align-items: center;
    }
    
    .message__author {
        width: 15px;
        height: 15px;
        padding: 2.5px;
        background: #34495e;
        border-radius: 50px;
        text-align: center;
        margin-right: .5em;
    }

    .message__text {
        padding: 0.25em .5em;
        background:#34495e;
        border-radius: 30px;
        width: fit-content;
    }

    .sent_message {
        float: right;
    }

    .sent_message .message__text {
        background: coral;
    }
</style>
