<template>
    <div class="conversations__ui">
        <h3 class="pt-1">Conversations</h3>
        
        <ul 
            class="conversation__list"
        >
            <li 
                v-for="(room, index) in rooms"
                :key="index"
                :value="room"
                v-on:click="$emit('roomChanged', room)"
            >
                {{ room.name }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['rooms', 'currentRoom'],
        data: () => {
            return {
                selected: '',
            };
        },
        created() {
            this.selected = this.currentRoom;
        }
    };
</script>

<style scoped>
    h3, p, li {
        color: #fefefe;
    }

    .conversations__ui {
        background: #2d2d2d;
        height: 100vh;
    }
    
    h3 {
        text-align: center;
    }
    
    .conversation__list {
        width: 20vw;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding-top: .5em;
        padding-left: 0;
    }

    li {
        display: flex;
        padding: 1em;
        width: 100%;
        background: #3d3d3d;
        border: 1px solid #2e2e2e;
        cursor: pointer;
    }
</style>