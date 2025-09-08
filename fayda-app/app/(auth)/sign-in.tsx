import InputField from '@/components/InputField';
import OAuth from '@/components/OAuth';
import { icons } from '@/constants';
import { Link } from 'expo-router';
import React, { useState } from 'react';
import { View, Text,TouchableOpacity } from 'react-native';

export default function Signin() {

    const [form,setForm]=useState({
        email:"",
        password:""
    });

    return (
        <View className=" flex-1 bg-primary">
            <View className="flex-1 mt-[28%] items-center">
                <View className="bg-white w-full flex  h-full rounded-t-[50px] p-7">
                    <View className="flex flex-cols gap-[1px]">
                        <Text className="text-2xl mb-2 font-JakartaBold">Let's get something</Text>
                        <Text className='text-[15px] text-neutral-400 '>Good to see you back.</Text>
                         <OAuth/>
                    </View>
                    <View className="flex flex-col mt-10 justify-between gap-3">
                        <InputField
                            icon={icons.email}
                            placeholder="Enter your email"
                            secureTextEntry={false}
                            value={form.email}
                            onChangeText={(value)=>setForm({...form,email:value})}
                        />
                        <InputField
                            icon={icons.lock}
                            placeholder="Enter your password"
                            secureTextEntry={true}
                            value={form.password}
                            onChangeText={(value)=>setForm({...form,password:value})}
                        />
                    </View>
                    <TouchableOpacity className=" p-5 w-full mt-10 mb-5 rounded-full
                  flex flex-row justify-center items-center shadow-md shadow-neutral-400/70 bg-[#ED1C24] ">
                        <Text className='text-white text-lg font-bold'>SIGN IN</Text>
                    </TouchableOpacity>
                    <Link href="/(auth)/sign-in" className="w-full  pl-6">
                        <Text className='text-[17px] font-JakartaMeduim text-neutral-400'>
                            Don't have account?
                        </Text>
                        <Text className="text-primary text-lg font-JakartaSemiBold">Sign up</Text>
                    </Link>
                </View>
            </View>
        </View>
    );
}
