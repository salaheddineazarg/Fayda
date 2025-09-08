import onboarding1 from "@/assets/images/onboarding1.jpg";
import onboarding2 from "@/assets/images/onboarding2.jpg";
import onboarding3 from "@/assets/images/onboarding3.jpg";
import google from "@/assets/icons/google.png";
import apple from "@/assets/icons/apple.png";
import user from "@/assets/icons/user.png";
import email from "@/assets/icons/email.png";
import lock from "@/assets/icons/lock.png";

export const images ={
    onboarding1,
    onboarding2,
    onboarding3
}

export const icons = {
   google,
   apple,
   user,
   email,
   lock
}

export const onboarding =[
    {
        id:1,
        title:"Welcome to Fayda!",
        description:" Discover surprise meal bags at special prices from your favorite local restaurants",
        image: images.onboarding1
    },
     {
        id:2,
        title:"Browse and order with ease!",
        description:"Browse restaurants and menus, and pick what fits your taste — right from the Fayda app.",
        image:images.onboarding2
    },
     {
        id:3,
        title:"Pick Up or Get It Delivered",
        description:" Reserve your secret bag in the app, pick it up yourself, or have it delivered to your door.",
        image:images.onboarding3
    }
]