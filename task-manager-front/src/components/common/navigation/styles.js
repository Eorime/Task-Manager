import styled from "styled-components";
import { Link } from "react-router-dom";

export const Container = styled.div`
	width: 100%;
	background-color: #ffffff;
	display: flex;
	align-items: center;
	padding: 1rem;
	justify-content: space-between;
	box-sizing: border-box;
`;
export const StyledLink = styled(Link)`
	color: inherit;
	text-decoration: none;
`;

export const NavASide = styled.div`
	display: flex;
	align-items: center;
	gap: 6rem;
`;

export const NavText = styled.span`
	color: #434951;
	transition: color 0.3s ease-in-out;

	&:hover {
		color: #000;
	}
`;

export const UserContainer = styled.div`
	display: flex;
	gap: 0.5rem;
`;

export const UserImageWrapper = styled.div`
	background-color: #d16464;
	border-radius: 100%;
	width: 2.3rem;
	height: 2.3rem;
`;

export const UserImage = styled.img``;

export const UserCredentialsContainer = styled.div`
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	padding-bottom: 0.2rem;
`;

export const UserCredentialsText = styled.span`
	color: #434951;
	font-size: 14px;
`;

export const UserCredentialsMail = styled.span`
	color: #434951;
	font-size: 11px;
`;
