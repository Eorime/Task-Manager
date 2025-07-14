import React from "react";
import {
	BottomContainer,
	CalendarSvg,
	Container,
	DateContainer,
	PriorityContainer,
	PriorityLabel,
	StatusLabel,
	TaskDescription,
	TaskLine,
	TaskTitle,
	TextContainer,
	TopContainer,
} from "./styles";

const TaskCard = ({ taskData }) => {
	return (
		<Container>
			<TopContainer>
				<PriorityContainer>
					<PriorityLabel></PriorityLabel>
				</PriorityContainer>
				<StatusLabel></StatusLabel>
			</TopContainer>
			<TextContainer>
				<TaskTitle></TaskTitle>
				<TaskDescription></TaskDescription>
			</TextContainer>
			<TaskLine></TaskLine>
		</Container>
	);
};

export default TaskCard;
