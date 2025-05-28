<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const totalOrders = ref(0);
const growth = ref(0);

const totalSales = ref(0);
const salesGrowth = ref(0);

const totalUsers = ref(0);
const usersGrowth = ref(0);

const totalMeals = ref(0);
const mealsGrowth = ref(0);

onMounted(async () => {
    const res = await axios.get("/api/order-stats");
    totalOrders.value = res.data.totalOrders;
    growth.value = res.data.percentGrowth;

    totalSales.value = res.data.totalSales;
    salesGrowth.value = res.data.salesGrowth;

    totalUsers.value = res.data.totalUsers;
    usersGrowth.value = res.data.usersGrowth;

    totalMeals.value = res.data.totalMeals;
    mealsGrowth.value = res.data.mealsGrowth;
});
</script>

<template>
    <!-- Header -->
    <div class="relative bg-polynesian md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!-- Card stats -->
                <div class="flex flex-wrap">
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <!-- Orders Card -->
                        <card-stats
                            statSubtitle="ORDERS"
                            :statTitle="totalOrders.toLocaleString()"
                            statArrow="up"
                            :statPercent="growth"
                            :statPercentColor="
                                growth >= 0
                                    ? 'text-emerald-500'
                                    : 'text-lighred'
                            "
                            statDescripiron="Since last month"
                            :statIconName="['fas', 'cart-shopping']"
                            statIconColor="bg-persian"
                        />
                    </div>
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <!-- Sales Card -->
                        <card-stats
                            statSubtitle="SALES"
                            :statTitle="'$' + totalSales.toLocaleString()"
                            statArrow="up"
                            :statPercent="salesGrowth "
                            :statPercentColor="
                                salesGrowth >= 0
                                    ? 'text-emerald-500'
                                    : 'text-lighred'
                            "
                            statDescripiron="Since last month"
                            :statIconName="['fas', 'dollar-sign']"
                            statIconColor="bg-green-500"
                        />
                    </div>
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <!-- Users Card -->
                        <card-stats
                            statSubtitle="USERS"
                            :statTitle="totalUsers.toLocaleString()"
                            statArrow="up"
                            :statPercent="usersGrowth"
                            :statPercentColor="
                                usersGrowth >= 0
                                    ? 'text-emerald-500'
                                    : 'text-lighred'
                            "
                            statDescripiron="Since last month"
                            :statIconName="['fas', 'user']"
                            statIconColor="bg-blue-500"
                            />
                          </div>
                          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <!-- Meals Card -->
                        <card-stats
                        statSubtitle="MEALS"
                            :statTitle="totalMeals.toLocaleString()"
                            statArrow="up"
                            :statPercent="mealsGrowth "
                            :statPercentColor="
                                mealsGrowth >= 0
                                ? 'text-emerald-500'
                                : 'text-lighred'
                                "
                            statDescripiron="Since last month"
                            :statIconName="['fas', 'utensils']"
                            
                            statIconColor="bg-purple-500"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CardStats from "@/Components/Cards/CardStats.vue";

export default {
    components: {
        CardStats,
    },
};
</script>
