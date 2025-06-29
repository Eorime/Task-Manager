import styled from "styled-components";
import { Link } from "react-router-dom";

export const Container = styled.div`
	width: 100%;
	background-color: #ffffff;
	display: flex;
	align-items: center;
	padding: 1.5rem;
`;

export const StyledLink = styled(Link)`
	color: inherit;
	text-decoration: none;
`;

export const NavText = styled.span`
	color: #434951;
	transition: color 0.3s ease-in-out;

	&: hover {
		color: #000;
	}
`;
