import { router } from "expo-router";
import { useRef, useState } from "react";
import { Text, Image, TouchableOpacity, View } from "react-native";
import Swiper from "react-native-swiper";
import { SafeAreaView } from 'react-native-safe-area-context';
import { onboarding } from "@/constants";


export default function Onboarding() {

    const swiperRef = useRef<Swiper>(null);
    const [activeIndex, setActiveIndex] = useState(0);
    const isLastSlide = activeIndex === onboarding.length - 1;

    return (
        <SafeAreaView className="flex h-full items-center justify-between bg-white">
            <TouchableOpacity onPress={() => {
                router.replace("/(auth)/sign-up");
            }}
                className="w-full flex items-end justify-end p-5"
            >
                <Text className="text-black text-md  font-JakartaBold">Skip</Text>
            </TouchableOpacity>
            <Swiper ref={swiperRef}
                loop={false}
                dot={<View className="w-[32px] h-[4px] mx-1 bg-[#E2E8F0] rounded-full" />}
                activeDot={<View className="w-[32px] h-[4px] mx-1 bg-[#ED1C24] rounded-full " />}
                onIndexChanged={(index) => setActiveIndex(index)}
            >
                {onboarding.map((item) => (
                    <View key={item.id} className="flex items-center justify-center">
                        <Image
                            source={item.image}
                            className="w-full h-[280px]"
                            resizeMode="contain"
                        />
                        <View className="flex flex-row items-center justify-center w-full mt-10 ">
                            <Text className="text-black text-3xl font-bold mx-10 text-center">{item.title}</Text>
                        </View>
                        <Text className="text-lg font-JakartaSemiBold text-center text-[#858585] mx-10 mt-3">{item.description}</Text>
                    </View>
                ))}
            </Swiper>
            <TouchableOpacity onPress={() => isLastSlide ? router.replace("/(auth)/sign-up")
                : swiperRef.current?.scrollBy(1)} className=" p-5 w-[85%] mb-4 rounded-full
                  flex flex-row justify-center items-center shadow-md shadow-neutral-400/70 bg-[#ED1C24] ">
                <Text className="text-white text-lg font-bold">{isLastSlide ? "Get Started" : "Next"}</Text>
            </TouchableOpacity>
        </SafeAreaView>

    );

}