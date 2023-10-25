<script setup>
    const pets = [{
            "tags:": ['Urgent'],
            "date": "01/01/23",
            "type": "cat",
            "gender": "male",
            "img": "/cat_test.jpg",
            "title": "Chaton Mistigri 3 mois",
            "desc": "Lorem ipsum dolor sit amet consect adipisicing elit. Vitae ullam error reprehenderit ut dolor illum excepturi quos fugiat tempore dolorem, aliquid, dicta repellat inventore nemo, at iste! Laborum maxime facilis in placeat perferendis neque nemo adipisci, laboriosam vero similique quae libero alias non quis. Vero ea possimus dolor laborum veniam?",      
        },
        {
            "tags:": ['Urgent'],
            "date": "01/01/23",
            "type": "cat",
            "gender": "male",
            "img": "../../images/cat_test.jpg",
            "title": "Chaton Mistigri 3 mois",
            "desc": "Lorem ipsum dolor sit amet consect adipisicing elit. Vitae ullam error reprehenderit ut dolor illum excepturi quos fugiat tempore dolorem, aliquid, dicta repellat inventore nemo, at iste! Laborum maxime facilis in placeat perferendis neque nemo adipisci, laboriosam vero similique quae libero alias non quis. Vero ea possimus dolor laborum veniam?",      
    },
    {
            "tags:": ['Urgent'],
            "date": "01/01/23",
            "type": "cat",
            "gender": "female",
            "img": ".../../images/cat_test.jpg",
            "title": "Chaton Tigresse 3 mois",
            "desc": "Lorem ipsum dolor sit amet consect adipisicing elit. Vitae ullam error reprehenderit ut dolor illum excepturi quos fugiat tempore dolorem, aliquid, dicta repellat inventore nemo, at iste! Laborum maxime facilis in placeat perferendis neque nemo adipisci, laboriosam vero similique quae libero alias non quis. Vero ea possimus dolor laborum veniam?",      
    }
]

</script>
<template>

     <div v-for="pet in pets" class="flex  bg-white border rounded-lg overflow-hidden max-h-28 m-2">
        <div class="container rounded-l-lg min-w-28 w-28 border">
            <img class="w-full object-cover h-28" :src="pet.img" />
        </div>
      
        <div class="flex flex-col  flex-1 min-w-0 w-full">
            <div class="flex justify-between">
               <div v-for="tag in pet['tags:']" class="rounded-full bg-red-300 mt-1 ml-2 text-xs text-center w-12">{{ tag }}</div>
                <span class="text-right mt-1 mr-3 text-xs">Publié le {{ pet.date }}</span>
            </div>
            <div class="flex">
                <h3 class="mt-2 ml-2">{{ pet.title }}</h3>
                <img class="ml-2 mt-4 w-3 h-3" v-if="pet.gender == 'male'" src="../../images/icon_male.png" />  
                <img class="ml-2 mt-4 w-3 h-3" v-if="pet.gender == 'female'" src="../../images/icon_female.png" />   
            </div>
            <p class="ml-2 mt-2 pb-3 max-h-9 max-w-md line-clamp text-xs"> {{ pet.desc }}</p>
        </div>
        
    </div>
</template>
<style>
.line-clamp {
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
}
</style>