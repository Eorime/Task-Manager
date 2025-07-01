import React from "react";
import {
	Container,
	NavASide,
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
			<NavASide>
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
			</NavASide>
			{/* //not loggedin? login, else log out */}
			<StyledLink>
				<NavText>Log In</NavText>
			</StyledLink>
		</Container>
	);
};

export default Navigation;
