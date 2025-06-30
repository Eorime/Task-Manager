import React from "react";
import {
	Container,
	NavText,
	StyledLink,
	UserContainer,
	UserCredentialsContainer,
	UserCredentialsMail,
	UserCredentialsText,
	UserImage,
	UserImageWrapper,
} from "./styles";

const Navigation = () => {
	return (
		<Container>
			<UserContainer>
				<UserImageWrapper>
					<UserImage />
				</UserImageWrapper>
				<UserCredentialsContainer>
					<UserCredentialsText>Your Name</UserCredentialsText>
					<UserCredentialsMail>yourmail@gmail.com</UserCredentialsMail>
				</UserCredentialsContainer>
			</UserContainer>
			<StyledLink>
				<NavText>All Tasks</NavText>
			</StyledLink>
		</Container>
	);
};

export default Navigation;
