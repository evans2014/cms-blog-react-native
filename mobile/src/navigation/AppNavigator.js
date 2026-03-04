import React from 'react';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { getFocusedRouteNameFromRoute } from '@react-navigation/native';
import BottomTabs from './BottomTabs';
import PageScreen from '../screens/PageScreen';
import PostDetailScreen from '../screens/PostDetailScreen';

const Stack = createNativeStackNavigator();

function getHeaderTitle(route) {
  const routeName = getFocusedRouteNameFromRoute(route) ?? 'Home';

  switch (routeName) {
    case 'Home':
      return 'Home';
    case 'News':
      return 'News';
    case 'About':
      return 'About Us';
	case 'Contact':
      return 'Contact';
    default:
      return 'Home';
  }
}

export default function AppNavigator() {
  return (
    <Stack.Navigator>
      <Stack.Screen
        name="Main"
        component={BottomTabs}
        options={({ route }) => ({
          title: getHeaderTitle(route),
        })}
      />

      <Stack.Screen
        name="PageDetail"
        component={PageScreen}
      />

      <Stack.Screen
        name="PostDetail"
        component={PostDetailScreen}
      />
    </Stack.Navigator>
  );
}
