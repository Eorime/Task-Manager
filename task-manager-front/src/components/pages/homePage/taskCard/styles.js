import styled from "styled-components";

export const Container = styled.div`
	background-color: #fff;
	width: 371px;
	height: auto;
	padding: 18px 17px 30px 18px;
	display: flex;
	flex-direction: column;
	border-radius: 5px;
`;

export const TopContainer = styled.div`
	display: flex;
	justify-content: space-between;
`;

export const PriorityContainer = styled.div`
	display: flex;
	align-items: center;
	justify-content: center;
	border: 1px solid grey;
	padding: 7px 11px;
	border-radius: 4px;
`;

export const PriorityLabel = styled.span`
	font-weight: bold;
	font-size: 14px;
`;

export const StatusLabel = styled.span`
	font-size: 14px;
	color: #434951;
	font-weight: bold;
`;

export const TextContainer = styled.div`
	display: flex;
	flex-direction: column;
`;

export const TaskTitle = styled.span`
	font-weight: bold;
	font-size: 18px;
	color: #434951;
`;

export const TaskDescription = styled.p`
	font-size: 14px;
	color: #747d85;
`;

export const TaskLine = styled.div`
	height: 2px;
	width: 100%;
	background-color: #f6f6f6;
`;

export const BottomContainer = styled.div`
	display: flex;
	flex-direction: row;
	justify-content: space-between;
`;

export const DateContainer = styled.div``;

export const CalendarSvg = styled.svg``;

export const DateLabel = styled.span``;

export const AssignedEmployeesContainer = styled.div``;

export const AssignedEmployee = styled.div``;
