import { Component } from "react";
import { routes } from "../constants/routes";
import Home from "../pages/homePage/Home";
import SignUp from "../pages/signUp/SignUp";

export const appRoutes = [
	{
		path: routes.home,
		Component: Home,
	},
	{
		path: routes.signUp,
		Component: SignUp,
	},
];
