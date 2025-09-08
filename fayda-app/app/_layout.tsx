
import { useFonts } from 'expo-font';
import { Stack } from 'expo-router';
import * as SplashScreen from 'expo-splash-screen'; 
import 'react-native-reanimated';
import "../global.css";
import { useEffect } from 'react';


SplashScreen.preventAutoHideAsync();

export default function RootLayout() {

  const [loaded] = useFonts({
          'Jakarta-Bold': require('../assets/fonts/PlusJakartaSans-Bold.ttf'),
          'Jakarta-BoldItalic': require('../assets/fonts/PlusJakartaSans-BoldItalic.ttf'),
          'Jakarta-ExtraBold': require('../assets/fonts/PlusJakartaSans-ExtraBold.ttf'),
          'Jakarta-ExtraBoldItalic': require('../assets/fonts/PlusJakartaSans-ExtraBoldItalic.ttf'),
          'Jakarta-ExtraLight': require('../assets/fonts/PlusJakartaSans-ExtraLight.ttf'),
          'Jakarta-ExtraLightItalic': require('../assets/fonts/PlusJakartaSans-ExtraLightItalic.ttf'),
          'Jakarta-Italic': require('../assets/fonts/PlusJakartaSans-Italic.ttf'),
          'Jakarta-Light': require('../assets/fonts/PlusJakartaSans-Light.ttf'),
          'Jakarta-LightItalic': require('../assets/fonts/PlusJakartaSans-LightItalic.ttf'),
          'Jakarta-Medium': require('../assets/fonts/PlusJakartaSans-Medium.ttf'),
          'Jakarta-MediumItalic': require('../assets/fonts/PlusJakartaSans-MediumItalic.ttf'),
          'Jakarta-Regular': require('../assets/fonts/PlusJakartaSans-Regular.ttf'),
          'Jakarta-SemiBold': require('../assets/fonts/PlusJakartaSans-SemiBold.ttf'),
          'Jakarta-SemiBoldItalic': require('../assets/fonts/PlusJakartaSans-SemiBoldItalic.ttf'),
  });

 

useEffect(() => {
    if (loaded) {
      SplashScreen.hideAsync();
    }
  }, [loaded]);

  if (!loaded) {
    
    return null;
  }

  return (
      <Stack>
        <Stack.Screen name="index" options={{ headerShown: false }} />
        <Stack.Screen name="(auth)" options={{ headerShown: false }} />
        <Stack.Screen name="+not-found" />
      </Stack>
  );
}
