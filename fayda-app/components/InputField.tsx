import { KeyboardAvoidingView, View, Text, TouchableWithoutFeedback, Image, TextInput, Platform, Keyboard, ImageSourcePropType, TextInputProps } from "react-native";



type InputFieldProps = {
    icon?: ImageSourcePropType;
    secureTextEntry?: boolean;
    containerStyle?: string;
    inputStyle?: string;
    iconStyle?: string;
    className?: string;
    placaholder?:string;
} & TextInputProps;

const InputField = ({

    icon,
    secureTextEntry = false,
    containerStyle,
    inputStyle,
    iconStyle,
    className,
    placaholder,
    ...props
}: InputFieldProps) => (

    <KeyboardAvoidingView behavior={Platform.OS === 'ios' ? 'padding' : 'height'}>
        <TouchableWithoutFeedback onPress={Keyboard.dismiss}>
            <View className={`flex flex-row justify-start items-center relative 
            bg-neutral-100 rounded-full border gap-2 border-neutral-100 focus:border-red-200 ${containerStyle}`}>
                {icon && (<Image source={icon} className={`w-6 h-6 ml-4 ${iconStyle}`} />)}
                <View className="h-5 bg-neutral-600 w-[1px]"></View>
                <TextInput
                    className={`rounded-full p-5 font-JakartaSemiBold text-[14px]
                 flex-1 text-left ${inputStyle}`}
                    secureTextEntry={secureTextEntry}
                    placeholderTextColor="#dddddd"
                    placeholder={placaholder}
                    {...props}
                />
            </View>
        </TouchableWithoutFeedback>
    </KeyboardAvoidingView>
)

export default InputField;