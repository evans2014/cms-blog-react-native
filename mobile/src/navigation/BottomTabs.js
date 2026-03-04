import React from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import HomeScreen from '../screens/HomeScreen';
import NewsScreen from '../screens/NewsScreen';
import PageScreen from '../screens/PageScreen';


const Tab = createBottomTabNavigator();

export default function BottomTabs() {
  return (
    <Tab.Navigator initialRouteName="Home" screenOptions={{ headerShown: false }}>
	<Tab.Screen
        name="HomeTab"
        component={PageScreen}
        initialParams={{ slug: 'home' }}
        options={{ title: 'Home' }}
      />
      <Tab.Screen name="Slider" component={HomeScreen} />
      <Tab.Screen name="News" component={NewsScreen} />
      <Tab.Screen
        name="About"
        component={PageScreen}
        initialParams={{ slug: 'about-us' }}
        options={{ title: 'About Us' }}
      />
	  <Tab.Screen
        name="Contact"
        component={PageScreen}
        initialParams={{ slug: 'contact' }}
        options={{ title: 'Contact' }}
      />
    </Tab.Navigator>
  );
}