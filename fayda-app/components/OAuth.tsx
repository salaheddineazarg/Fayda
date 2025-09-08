import React, { useEffect } from "react";
import { Image, TouchableWithoutFeedback, View } from "react-native";
import * as WebBrowser from "expo-web-browser";
import * as Google from "expo-auth-session/providers/google";
import { icons } from "@/constants";
import Constants from 'expo-constants';

WebBrowser.maybeCompleteAuthSession();

export default function OAuth() {
  const [request, response, promptAsync] = Google.useAuthRequest({
    iosClientId: Constants.expoConfig?.extra?.GOOGLE_IOS_CLIENT_ID,
    androidClientId: Constants.expoConfig?.extra?.GOOGLE_ANDROID_CLIENT_ID,
  });

  useEffect(() => {
    if (response?.type === "success") {
      const id_token = (response.authentication as any).id_token;

      fetch(`${Constants.expoConfig?.extra?.API_BASE_URL}/auth/google`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id_token }),
      })
        .then(res => res.json())
        .then(data => {
          console.log("Laravel Response:", data);
        })
        .catch(err => console.error("Login error:", err));
    }
  }, [response]);

  return (
    <View className="flex flex-row items-center mt-5 gap-[15px] w-full">
      <TouchableWithoutFeedback >
        <Image
          source={icons.google}
          resizeMode="contain"
          className="w-[45px] h-[45px]"
        />
      </TouchableWithoutFeedback>

      <TouchableWithoutFeedback>
        <Image
          source={icons.apple}
          resizeMode="contain"
          className="w-[45px] h-[45px] mb-2"
        />
      </TouchableWithoutFeedback>
    </View>
  );
}
